<?php namespace Informulate\Projects;

class ProjectRepository {

	public function save(Project $project)
	{
		return $project->save();
	}
}
