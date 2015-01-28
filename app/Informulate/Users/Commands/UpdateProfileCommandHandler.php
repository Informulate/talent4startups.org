<?php namespace Informulate\Users\Commands;

use Informulate\Users\Profile;
use Informulate\Users\ProfileRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateProfileCommandHandler implements CommandHandler
{
	use DispatchableTrait;

	/**
	 * @var ProfileRepository
	 */
	protected $repository;

	/**
	 * @param ProfileRepository $repository
	 */
	function __construct(ProfileRepository $repository)
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
		$profile = Profile::updateProfile(
			$command->user, $command->profileInfo
		);

		$this->repository->save($profile);

		if (array_key_exists('skills', $command->profileInfo)) {
			$this->repository->updateSkills($profile, $command->profileInfo['skills']);
		}

		$this->dispatchEventsFor($profile);

		return $profile;
	}
}
