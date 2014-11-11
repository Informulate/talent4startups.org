<?php namespace Informulate\Startups;

use Informulate\Users\User;

class RequestStartupMembershipCommand
{
	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var string $startup
	 */
	public $startup;

	/**
	 * @param User $user
	 * @param Startup $startup
	 */
	function __construct(User $user, Startup $startup)
	{
		$this->user = $user;
		$this->startup = $startup;
	}
}
