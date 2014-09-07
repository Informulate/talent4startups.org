<?php namespace Informulate\Users;

class UpdateProfileCommand {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var string first_name
	 */
	public $first_name;

	/**
	 * @var string last_name
	 */
	public $last_name;

	/**
	 * @var boolean active
	 */
	public $active;

	/**
	 * @param User $user
	 * @param $first_name
	 * @param $last_name
	 */
	function __construct(User $user, $first_name, $last_name)
	{
		$this->user = $user;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
	}

}
