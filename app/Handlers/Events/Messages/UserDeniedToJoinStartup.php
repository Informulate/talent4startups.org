<?php namespace App\Handlers\Events\Messages;

use App\Events\UserDeniedToJoinStartup as UserDeniedToJoinStartupEvent;

use App\Repositories\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;

class UserDeniedToJoinStartup {

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
     * @param UserDeniedToJoinStartupEvent $userDenied
     */
	public function handle(UserDeniedToJoinStartupEvent $userDenied)
	{
        ThreadRepository::notification('startup.join.request.deny.talent', $userDenied->user, array('startup' => $userDenied->startup));
	}

}
