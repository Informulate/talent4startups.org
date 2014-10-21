<?php namespace Informulate\Projects;

use Cocur\Slugify\Slugify;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class RequestProjectMembershipCommandHandler implements CommandHandler{

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
		if (false === $command->project->hasMember($command->user)) {
			$this->repository->addMemberRequest($command->user, $command->project);

			$this->dispatchEventsFor($command->project);
		}

		return $command->project;
	}
}
