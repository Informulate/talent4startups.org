<?php namespace Informulate\Startups\Commands;

use Informulate\Users\User;

class CreateNewStartupCommand
{
	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var array projectInfo
	 */
	public $startup;

	/**
	 * @param User $user
	 * @param $startup
	 */
	function __construct(User $user, $startup)
	{
		$this->user = $user;
		$this->startup = $startup;
	}
}
