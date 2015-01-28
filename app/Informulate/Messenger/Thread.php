<?php namespace Informulate\Messenger;

use Illuminate\Support\Collection;

class Thread extends \Cmgmyr\Messenger\Models\Thread
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
            ->where('participants.user_id', $userId)
            ->whereNull('participants.deleted_at')
            ->selectRaw('threads.*, CASE WHEN threads.updated_at <= participants.last_read THEN 1 ELSE 0 END AS message_read')
            ->orderByRaw('message_read ASC, threads.updated_at DESC');
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
}