<?php namespace Informulate\Projects;

use Informulate\Users\User;

class CreateNewProjectCommand {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var array projectInfo
	 */
	public $projectInfo;

	/**
	 * @param User $user
	 * @param $project data
	 */
	function __construct(User $user,$projectInfo)
	{
		$this->user = $user;
		$this->projectInfo = $projectInfo;
	}

}
