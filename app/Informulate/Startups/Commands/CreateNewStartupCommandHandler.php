<?php namespace Informulate\Startups\Commands;

use Cocur\Slugify\Slugify;
use Informulate\Startups\Startup;
use Informulate\Startups\StartupRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateNewStartupCommandHandler implements CommandHandler
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
		$slugify = Slugify::create();
		$startup = Startup::create(
			[
				'user_id' => $command->user->id,
				'name' => $command->startup->name,
				'description' => $command->startup->description,
				'url' => $slugify->slugify($command->startup->name),
//				'stage_id' => $command->startup->stage_id,
				'video' => $command->startup->video,
				'published' => true
			]
		);

		$this->repository->save($startup);

		if (isset($command->startup->tags)) {
			$this->repository->updateTags($startup, $command->startup->tags);
		}

		if (isset($command->startup->needs)) {
			$this->repository->updateNeeds($startup, $command->startup->needs);
		}

		$this->dispatchEventsFor($startup);

		return $startup;
	}
}
