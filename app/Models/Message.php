<?php

namespace App\Models;

use Cmgmyr\Messenger\Models\Message as CmgmyrMessage;
use Illuminate\Support\Facades\Event;
use Informulate\Messenger\Events\NewMessage;
use Misd\Linkify\Linkify;

class Message extends CmgmyrMessage
{
	/**
	 * The attributes that can be set with Mass Assignment.
	 *
	 * @var array
	 */
	protected $fillable = ['thread_id', 'user_id', 'body', 'type'];

	public static function boot()
	{
		parent::boot();

		// Since using Participant::restored triggers before the message is actually saved, let's fire the event when the message is created.
		Message::created(self::raiseEvent());
	}

	public function linkify()
	{
		$linkify = new Linkify();
		return $linkify->process($this->body);
	}

	/**
	 * @return callable
	 */
	private static function raiseEvent()
	{
		return function ($message) {
			// Notify all participants of the new message.
			$participants = $message->thread->participants;

			foreach ($participants as $participant) {
				if ($participant->user->id != $message->user->id) {
//					Event::fire('Informulate.Messenger.Events.NewMessage', [new NewMessage($participant)]);
				}
			}

			return $message;
		};
	}
}
