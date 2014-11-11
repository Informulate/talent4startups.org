<?php namespace Informulate\Startups;

use Informulate\Users\User;

class UpdateStartupMembershipCommand
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
	 * @var string $action
	 */
	public $action;

	/**
	 * @param User $user
	 * @param Startup $startup
	 * @param $action
	 */
	function __construct(User $user, Startup $startup, $action)
	{
		$this->user = $user;
		$this->startup = $startup;
		$this->action = $action;
	}
}
