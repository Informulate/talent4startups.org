<?php namespace App\Handlers\Events\Messages;

use App\Events\UserLeftStartup as UserLeftStartupEvent;

use App\Repositories\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;

class UserLeftStartup {

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
     * @param UserLeftStartupEvent $userLeft
     * @internal param UserLeftStartup $event
     */
	public function handle(UserLeftStartupEvent $userLeft)
	{
        ThreadRepository::notification('startup.left.talent', $userLeft->user, array('startup' => $userLeft->startup));
        ThreadRepository::notification('startup.left.founder', $userLeft->startup->owner, array('startup' => $userLeft->startup, 'talent' => $userLeft->user));
	}

}
