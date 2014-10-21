<?php namespace Informulate\Users;

class UpdateProfileCommand {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var object profileInfo
	 */
	public $profileInfo;

	/**
	 * @var boolean active
	 */
	public $active;

	/**
	 * @param User $user
	 * @param $first_name
	 * @param $last_name
	 */
	function __construct(User $user, $profileInfo)
	{
		$this->user = $user;
		$this->profileInfo = $profileInfo;
	}

}
