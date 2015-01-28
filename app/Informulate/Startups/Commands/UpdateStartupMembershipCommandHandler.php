<?php namespace Informulate\Startups;

use Flash;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateStartupMembershipCommandHandler implements CommandHandler
{
	use DispatchableTrait;

	/**
	 * @var StartupRepository
	 */
	protected $repository;

	/**
	 * @param StartupRepository $repository
	 */
	function __construct(StartupRepository $repository)
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
		switch ($command->action) {
			case 'approve':
				$this->repository->approveMemberRequest($command->user, $command->startup);
				Flash::message("Congratulations! {$command->user->profile->first_name} {$command->user->profile->last_name} has been accepted into your startup!");
				break;
			case 'reject':
				$this->repository->rejectMemberRequest($command->user, $command->startup);
				Flash::message("{$command->user->profile->first_name} {$command->user->profile->last_name} has been rejected from your startup!");
				break;
		}

		return $command->startup;
	}
}
