<?php namespace Informulate\Startups\Commands;

use Cocur\Slugify\Slugify;
use Informulate\Startups\Startup;
use Informulate\Startups\StartupRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateStartupCommandHandler implements CommandHandler{

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
		$startup = $command->startup;

		$startup->name = $command->data['name'];
		$startup->description = $command->data['description'];
		$startup->url = $slugify->slugify($command->data['name']);
		$startup->stage_id = $command->data['stage_id'];
		$startup->video = $command->data['video'];
		$startup->published = true;

		$this->repository->save($startup);

		if (isset($command->data['tags'])) {
			$startup->tags()->detach();
			$startup->tags()->attach($command->data['tags']);
		}

		if (isset($command->data['needs'])) {
			$startup->needs()->detach();
			$startup->needs()->attach($command->data['needs']);
		}

		$this->dispatchEventsFor($startup);

		return $startup;
	}
}
