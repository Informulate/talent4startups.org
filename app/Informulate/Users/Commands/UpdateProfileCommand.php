<?php namespace Informulate\Users\Commands;

use Informulate\Users\User;

class UpdateProfileCommand {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var array profileInfo
	 */
	public $profileInfo;

	/**
	 * @var boolean active
	 */
	public $active;

	/**
	 * @param User $user
	 * @param $profileInfo
	 */
	function __construct(User $user, $profileInfo)
	{
		$this->user = $user;
		$this->profileInfo = $profileInfo;
	}

}
