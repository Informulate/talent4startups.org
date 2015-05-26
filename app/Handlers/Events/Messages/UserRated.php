<?php

namespace App\Handlers\Events\Messages;

use App\Events\UserRated as UserRatedEvent;
use App\Repositories\ThreadRepository;

class UserRated
{

	/**
	 * Create the event handler.
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param UserRatedEvent $userRated
	 */
	public function handle(UserRatedEvent $userRated)
	{
		ThreadRepository::notification('talent.rating.talent', $userRated->user, array());
	}

}
