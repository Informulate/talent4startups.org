<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Participant;
use App\Models\Thread;
use App\Models\Message;
use App\Repositories\UserRepository;
use Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth, Input, Redirect, Session;
use Response;

class MessagesController extends Controller
{

	private $userRepository;

	/**
	 * Constructor
	 * @param UserRepository $userRepository
	 */
	function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
		$this->middleware('auth');
		$this->middleware('profile.complete');
	}

	/**
	 * Show all of the message threads to the user
	 *
	 * @return mixed
	 */
	public function index()
	{
		$currentUserId = Auth::user()->id;
		$threads = Thread::ForUserByPriority($currentUserId, \Request::get('filter', 'message'))->paginate(10);

		return view('messenger.index', compact('threads', 'currentUserId'));
	}

	/**
	 * Shows a message thread
	 *
	 * @param $id
	 * @return mixed
	 */
	public function show($id)
	{
		try {
			$thread = Thread::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

			return Redirect::to('messages');
		}

		// show current user in list if not a current participant
		// $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

		// don't show the current user in list
		$userId = Auth::user()->id;
		$users = new \ArrayObject(); //User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

		$thread->markAsRead($userId);
		$currentUserId = Auth::user()->id;
		$messages = $thread->messages()->orderBy('created_at', 'desc')->paginate(5);

		if (\Request::ajax()) {
			$html = view('messenger.show', compact('thread', 'messages', 'users', 'currentUserId'))->renderSections(array('content'));
			return $html['content'];
		} else {
			return view('messenger.show', compact('thread', 'messages', 'users', 'currentUserId'));
		}
	}

	/**
	 * Creates a new message thread
	 *
	 * @param null $recipient
	 * @return mixed
	 */
	public function create($recipient = null)
	{
		$users = User::where('id', '!=', Auth::id())->get();

		if (!empty($recipient)) {
			$recipient = User::where('id', '=', $recipient)->first();
		} else {
			$recipient = new User();
		}

		return view('messenger.create', compact('users', 'recipient'));
	}

	/**
	 * Stores a new message thread
	 *
	 * @return mixed
	 */
	public function store()
	{
		$input = Input::all();

		$thread = Thread::create(
			[
				'subject' => $input['subject'],
			]
		);

		// Message
		$message = Message::create(
			[
				'thread_id' => $thread->id,
				'user_id'   => Auth::user()->id,
				'body'      => strip_tags($input['message']),
			]
		);

		// Sender
		Participant::create(
			[
				'thread_id' => $thread->id,
				'user_id'   => Auth::user()->id,
				'last_read' => new Carbon
			]
		);

		// Recipients
		if (Input::has('recipients')) {
			$recipients = array_filter(explode(',', trim($input['recipients'])));
			$recipientsAllowed = array();

			foreach ($recipients as $recipient) {
				// Until further notice, remove the check to see if the participant is allowed to message each other
//				if (UserRepository::canMessage($recipient)) {
					$recipientsAllowed[] = $recipient;
//				}
			}

			$thread->addParticipants($recipientsAllowed);
		}

		$participants = $message->thread->participants;

		foreach ($participants as $participant) {
			if ($participant->user->id != $message->user->id) {
				Event::fire('App.Events.NewMessage', [new NewMessage($participant)]);
			}
		}

		return Redirect::to('messages');
	}

	/**
	 * Adds a new message to a current thread
	 *
	 * @param $id
	 * @return mixed
	 */
	public function update($id)
	{
		try {
			$thread = Thread::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

			return Redirect::to('messages');
		}

		$thread->activateAllParticipants();

		// Message
		Message::create(
			[
				'thread_id' => $thread->id,
				'user_id'   => Auth::id(),
				'body'      => strip_tags(Input::get('message')),
			]
		);

		// Add replier as a participant
		$participant = Participant::firstOrCreate(
			[
				'thread_id' => $thread->id,
				'user_id'   => Auth::user()->id
			]
		);
		$participant->last_read = new Carbon;
		$participant->save();

		// Recipients
		if (Input::has('recipients')) {
			$thread->addParticipants(Input::get('recipients'));
		}

		return Redirect::to('messages');
	}

	/**
	 * Search for recipients when composing a message
	 * @param $query
	 * @return mixed
	 */
	public function searchRecipients($query)
	{
		$users = $this->userRepository->search($query);

		return Response::json($users);
	}

	/**
	 * Mark thread read
	 *
	 * @param $threadId
	 * @return mixed
	 */
	public function markRead($threadId)
	{
		try {
			$thread = Thread::findOrFail($threadId);
		} catch (ModelNotFoundException $e) {
			Session::flash('error_message', 'The thread with ID: ' . $threadId . ' was not found.');

			return Redirect::to('messages');
		}

		$thread->markAsRead(Auth::id());

		return Redirect::to('messages/');
	}

	/**
	 * Mark thread unread
	 *
	 * @param $threadId
	 * @return mixed
	 */
	public function markUnread($threadId)
	{
		try {
			$thread = Thread::findOrFail($threadId);
		} catch (ModelNotFoundException $e) {
			Session::flash('error_message', 'The thread with ID: ' . $threadId . ' was not found.');

			return Redirect::to('messages');
		}
		$thread->markAsUnRead(Auth::id());

		return Redirect::to('messages/');
	}

	/**
	 * Delete a thread
	 *
	 * @param $threadId
	 * @return mixed
	 */
	public function delete($threadId)
	{
		try {
			$thread = Thread::findOrFail($threadId);
		} catch (ModelNotFoundException $e) {
			Session::flash('error_message', 'The thread with ID: ' . $threadId . ' was not found.');

			return Redirect::to('messages');
		}
		$thread->delete();

		return Redirect::to('messages/');
	}
}
