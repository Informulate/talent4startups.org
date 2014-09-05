<?php namespace Informulate\Projects\Events;

use Informulate\Projects\Project;

class ProjectCreated {

	/**
	 * @var Project
	 */
	public $project;

	/**
	 * @param Project $project
	 */
	function __construct(Project $project)
	{
		$this->project = $project;
	}

}
