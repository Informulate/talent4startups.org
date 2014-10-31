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
				'name' => $command->projectInfo->name,
				'description' => $command->projectInfo->description,
				'url' => $slugify->slugify($command->projectInfo->name),
				'goal' => $command->projectInfo->goal,
				'stage_id' => $command->projectInfo->stage_id,
				'video' => $command->projectInfo->video
			]
		);

		$this->repository->save($project);

		$this->dispatchEventsFor($project);

		return $project;
	}
}
