<?php namespace Informulate\Startups;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class RequestStartupMembershipCommandHandler implements CommandHandler{

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
		if (false === $command->startup->hasMember($command->user)) {
			$this->repository->addMemberRequest($command->user, $command->startup);

			$this->dispatchEventsFor($command->startup);
		}

		return $command->startup;
	}
}
