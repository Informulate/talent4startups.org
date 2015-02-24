<?php namespace Informulate\Users\Events;

use Informulate\Users\Profile;
use Informulate\Users\User;

class ProfileCreated
{
	/**
	 * @var Profile
	 */
	public $profile;
	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @param Profile $profile
	 */
	function __construct(Profile $profile)
	{
		$this->profile = $profile;
		$this->user = $profile->user;
	}
}
