<?php namespace Informulate\Users\Events;

use Informulate\Users\User;

class ProfileCreated
{
	/**
	 * @var User
	 */
	public $user;

	/**
	 * @param User $user
	 */
	function __construct(User $user)
	{
		$this->user = $user;
	}
}
