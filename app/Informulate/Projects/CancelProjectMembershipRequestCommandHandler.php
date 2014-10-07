<?php namespace Informulate\Projects;

use Cocur\Slugify\Slugify;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CancelProjectMembershipRequestCommandHandler implements CommandHandler{

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
		if ($command->project->hasMember($command->user)) {
			$this->repository->cancelMembershipRequest($command->user, $command->project);

			$this->dispatchEventsFor($command->project);
		}

		return $command->project;
	}
}
