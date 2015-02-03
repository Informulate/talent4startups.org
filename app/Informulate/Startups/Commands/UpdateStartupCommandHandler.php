<?php namespace Informulate\Startups\Commands;

use Informulate\Startups\Startup;
use Informulate\Startups\StartupRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateStartupCommandHandler implements CommandHandler
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

		$startup = Startup::updateStartup(
			$command->startup, $command->data
		);

		$this->repository->save($startup);
		if (isset($command->data['tags'])) {
			$this->repository->updateTags($startup, $command->data['tags']);
		}

		if (isset($command->data['needs'])) {
			$this->repository->updateNeeds($startup, $command->data['needs']);
		}

		$this->dispatchEventsFor($startup);

		return $startup;
	}
}
