<?php namespace App\Handlers\Events\Messages;

use App;
use App\Events\NewMessage as NewMessageEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class NewMessage {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

    /**
     * Handle the event.
     *
     * @param NewMessageEvent $newMessage
     */
	public function handle(NewMessageEvent $newMessage)
	{
        // To prevent codeception for hanging to long, only send the emails when in dev or prod
        if (App::environment() !== 'testing') {
            $participant = $newMessage->participant;

            try {
                $content = [
                    'recipient' => [
                        'first_name' => $participant->user->profile->first_name,
                        'last_name' => $participant->user->profile->last_name,
                    ],
                    'body' => $participant->thread->getLatestMessageAttribute()->body,
                ];

                Mail::send(['html' => 'emails.message'], $content, function ($message) use ($participant) {
                    $message
                        ->from('noreply@talent4startups.org', 'Talent4Startups')
                        ->to($participant->user->email, $participant->user->profile->first_name . ' ' . $participant->user->profile->last_name)
                        ->subject("T4S: {$participant->thread->subject}")
                    ;
                });
            } catch (\Exception $e) {
                // TODO: Raise a Slack notification
            }
        }
	}

}
