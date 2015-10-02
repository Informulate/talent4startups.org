<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\Thread;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\View;

class ThreadRepository
{
	public static function notification($template, $recipient, $variables)
	{
		$variables['recipient'] = $recipient;
		if ($recipient instanceof User) {
			$recipient = array($recipient);
		}

		foreach ($recipient as $user) {

			$messageParts = View::make('messenger.templates.' . $template, $variables)->renderSections();
			$thread = Thread::create(
				[
					'subject' => trim($messageParts['subject']),
				]
			);

			// Message
			Message::create(
				[
					'thread_id' => $thread->id,
					'user_id' => $user->id,
					'body' => $messageParts['body'] . $messageParts['footer'],
					'type' => 'notification',
				]
			);

			// Sender
			Participant::create(
				[
					'thread_id' => $thread->id,
					'user_id' => $user->id,
				]
			);

			// Recipients
			$thread->addParticipants(array($user->id));
		}
	}
}
