<?php namespace Informulate\Projects;

use Cocur\Slugify\Slugify;
use Flash;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateProjectMembershipCommandHandler implements CommandHandler{

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
		switch($command->action) {
			case 'approve':
				$this->repository->approveMemberRequest($command->user, $command->project);
				Flash::message("Congratulations! {$command->user->profile->first_name} {$command->user->profile->last_name} has been accepted into your project!");
				break;
			case 'reject':
				$this->repository->rejectMemberRequest($command->user, $command->project);
				Flash::message("{$command->user->profile->first_name} {$command->user->profile->last_name} has been rejected from your project!");
				break;
		}

		return $command->project;
	}
}
