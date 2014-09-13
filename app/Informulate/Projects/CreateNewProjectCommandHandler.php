<?php namespace Informulate\Projects;

use Cocur\Slugify\Slugify;
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
		$slugify = Slugify::create();
		$project = Project::create(
			[
				'user_id' => $command->user->id,
				'name' => $command->name,
				'description' => $command->description,
				'url' => $slugify->slugify($command->name)
			]
		);

		$this->repository->save($project);

		$this->dispatchEventsFor($project);

		return $project;
	}
}
