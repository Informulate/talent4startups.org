<?php namespace App\Handlers\Events\Messages;

use App\Events\ProfileCreated as ProfileCreatedEvent;

use App\Repositories\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;

class ProfileCreated {

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
	 * @param  ProfileCreatedEvent  $profileCreated
	 * @return void
	 */
	public function handle(ProfileCreatedEvent $profileCreated)
	{
        switch ($profileCreated->user->type) {
            case 'talent':
                ThreadRepository::notification('auth.registration.talent', $profileCreated->user, array('user' => $profileCreated->user));
                break;
            case 'startup':
                ThreadRepository::notification('auth.registration.startup', $profileCreated->user, array('user' => $profileCreated->user));
                break;
        }
	}

}
