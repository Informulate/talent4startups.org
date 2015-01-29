<?php namespace Informulate\Ratings\Commands;

use Informulate\Ratings\Rating;
use Informulate\Ratings\RatingRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class RateUserCommandHandler implements CommandHandler
{
	use DispatchableTrait;

	/**
	 * @var RatingRepository
	 */
	private $repository;

	/**
	 * @param RatingRepository $repository
	 */
	function __construct(RatingRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return Rating
	 */
	public function handle($command)
	{
		$this->prepareMorphFields($command);

		$rating = $this->repository->update($command->rating, $command->rated_id, $command->rated_type, $command->rated_by_id, $command->rated_by_type);

		if (! $rating) {
			$rating = $this->repository->create($command->rating, $command->rated_id, $command->rated_type, $command->rated_by_id, $command->rated_by_type);
		}

		$this->repository->save($rating);

		$this->dispatchEventsFor($rating);

		return $rating;
	}

	/**
	 * @param $command
	 */
	private function prepareMorphFields(&$command)
	{
		switch ($command->rated_type) {
			case 'startup':
				$command->rated_type = 'Informulate\\Startups\\Startup';
				$command->rated_by_type = 'Informulate\\Users\\User';
				break;
			default:
				$command->rated_type = 'Informulate\\Users\\User';
				$command->rated_by_type = 'Informulate\\Startups\\Startup';
                ThreadRepository::notification('talent.rating.talent', $user, array());
				break;
		}
	}
}
