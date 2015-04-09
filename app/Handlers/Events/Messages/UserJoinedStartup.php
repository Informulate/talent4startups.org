<?php namespace App\Handlers\Events\Messages;

use App\Events\UserJoinedStartup as UserJoinedStartupEvent;

use App\Repositories\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class UserJoinedStartup {

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
     * @param UserJoinedStartupEvent $userJoined
     */
	public function handle(UserJoinedStartupEvent $userJoined)
	{
        ThreadRepository::notification('startup.join.talent', $userJoined->user, array('startup' => $userJoined->startup));
        ThreadRepository::notification('startup.join.owner', $userJoined->startup->owner, array('startup' => $userJoined->startup, 'talent' => $userJoined->user));
	}

}
