<?php namespace App\Handlers\Events\Messages;

use App\Events\UserAppliedToJoinStartup as UserAppliedToJoinStartupEvent;

use App\Repositories\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class UserAppliedToJoinStartup {

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
     * @param UserAppliedToJoinStartupEvent $userApplied
     */
	public function handle(UserAppliedToJoinStartupEvent $userApplied)
	{
        ThreadRepository::notification('startup.join.request.owner', $userApplied->startup->owner, array('startup' => $userApplied->startup, 'talent' => $userApplied->user));
	}

}
