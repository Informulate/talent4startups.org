<?php namespace Informulate\Projects;

use Informulate\Users\User;

class UpdateProjectMembershipCommand {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var string $project
	 */
	public $project;

	/**
	 * @var string $action
	 */
	public $action;

	/**
	 * @param User $user
	 * @param Project $project
	 * @param $action
	 */
	function __construct(User $user, Project $project, $action)
	{
		$this->user = $user;
		$this->project = $project;
		$this->action = $action;
	}

}
