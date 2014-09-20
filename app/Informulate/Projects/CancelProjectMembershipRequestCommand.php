<?php namespace Informulate\Projects;

use Informulate\Users\User;

class CancelProjectMembershipRequestCommand {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var string $project
	 */
	public $project;

	/**
	 * @param User $user
	 * @param Project $project
	 */
	function __construct(User $user, Project $project)
	{
		$this->user = $user;
		$this->project = $project;
	}

}
