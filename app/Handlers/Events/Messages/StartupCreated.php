<?php namespace App\Handlers\Events\Messages;

use App\Events\StartupCreated as StartupCreatedEvent;

use App\Repositories\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class StartupCreated {

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
     * @param StartupCreatedEvent $startupCreated
     */
	public function handle(StartupCreatedEvent $startupCreated)
	{
        ThreadRepository::notification('startup.created.owner', $startupCreated->startup->owner, array('startup' => $startupCreated->startup));
	}

}
