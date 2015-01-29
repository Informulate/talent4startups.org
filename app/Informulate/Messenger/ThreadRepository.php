<?php namespace Informulate\Users;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Informulate\Messenger\Message;
use Informulate\Messenger\Thread;
use Informulate\Users\User;

class ThreadRepository
{
	public static function notification($template, $recipient, $variables)
    {
        $variables['recipient'] = $recipient;
        if ($recipient instanceof User) {
            $recipient = array($recipient);
        }

        /* @var $view \Illuminate\View\View */

        foreach ($recipient as $user) {

            $messageParts = View::make('messenger.templates.' . $template, $variables)->renderSections();

            $thread = Thread::create(
                [
                    'subject' => $messageParts['subject'],
                ]
            );

            // Message
            Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id' => $user->id,
                    'body' => $messageParts['body'],
                    'type' => 'notification',
                ]
            );

            // Sender
            Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id' => $user->id,
                    //'last_read' => new Carbon
                ]
            );

            // Recipients
            $thread->addParticipants(array($user->id));
        }
    }
}
