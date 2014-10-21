<?php namespace Informulate\Projects;

use Informulate\Users\User;

class CreateNewProjectCommand {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var string username
	 */
	public $name;

	/**
	 * @var string email
	 */
	public $description;

	/**
	 * @param User $user
	 * @param $name
	 * @param $description
	 */
	function __construct(User $user, $name, $description)
	{
		$this->user = $user;
		$this->name = $name;
		$this->description = $description;
	}

}
