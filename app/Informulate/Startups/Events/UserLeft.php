<?php namespace Informulate\Startups\Events;

use Informulate\Startups\Startup;
use Informulate\Users\User;

class UserLeft
{
	/**
	 * @var Startup
	 */
	public $startup;

    /**
     * @var User
     */
    public $user;

	/**
	 * @param Startup $startup
	 */
	function __construct(Startup $startup, User $user)
	{
		$this->startup = $startup;
        $this->user = $user;
	}
}
