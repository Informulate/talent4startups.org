<?php

namespace App\Models;

use Cmgmyr\Messenger\Models\Thread as CmgmyrThread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Thread extends CmgmyrThread
{
	/**
	 * Returns threads with new messages that the user is associated with
	 *
	 * @param $query
	 * @param $userId
	 * @return mixed
	 */
	public function scopeForUserByPriority($query, $userId)
	{
		return $query->join('participants', 'threads.id', '=', 'participants.thread_id')
			->join('messages', function ($join) {
				$join->on('threads.id', '=', 'messages.thread_id')
					->on('messages.user_id', '!=', DB::raw('participants.user_id'))
					->orOn('messages.type', '=', DB::raw('"notification"'));
			})
			->where('participants.user_id', $userId)
			->whereNull('participants.deleted_at')
			->selectRaw('threads.*, CASE WHEN threads.updated_at <= participants.last_read THEN 1 ELSE 0 END AS message_read')
			->orderByRaw('message_read ASC, threads.updated_at DESC')
			->groupBy('threads.id');
	}

	/**
	 * Returns an array of users that are associated with the thread
	 *
	 * @return array
	 */
	public function participantsUsers()
	{
		$users = array();

		foreach ($this->participants()->get() as $participant) {
			$users[$participant->user->id] = $participant->user;
		}


		return new Collection($users);
	}

	/**
	 * Messages relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function messages()
	{
		return $this->hasMany('App\Models\Message');
	}

	/**
	 * Mark a thread as unread for a user
	 *
	 * @param integer $userId
	 */
	public function markAsUnRead($userId)
	{
		try {
			$participant = $this->getParticipantFromUser($userId);
			$participant->last_read = null;
			$participant->save();
		} catch (ModelNotFoundException $e) {
		}
	}

	/**
	 * Participants relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function participants()
	{
		return $this->hasMany('App\Models\Participant');
	}
}
