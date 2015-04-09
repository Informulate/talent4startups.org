<?php namespace App\Handlers\Events\Messages;

use App\Events\StartupRated as StartupRatedEvent;

use App\Repositories\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class StartupRated {

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
     * @param StartupRatedEvent $startupRated
     */
	public function handle(StartupRatedEvent $startupRated)
	{
        ThreadRepository::notification('startup.rating.owner', $startupRated->startup->owner, array('startup' => $startupRated->startup));
	}

}
