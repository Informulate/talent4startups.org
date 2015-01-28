<?php namespace Informulate\Registration\Events;

use Informulate\Users\User;

class UserRegistered
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
