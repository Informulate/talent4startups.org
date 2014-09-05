<?php namespace Informulate\Projects;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateNewProjectCommandHandler implements CommandHandler{

	use DispatchableTrait;

	/**
	 * @var ProjectRepository
	 */
	protected $repository;

	/**
	 * @param ProjectRepository $repository
	 */
	function __construct(ProjectRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		$project = Project::create(
			[
				'name' => $command->name,
				'description' => $command->description
			]
		);

		$this->repository->save($project);

		$this->dispatchEventsFor($project);

		return $project;
	}
}
