<?php namespace Informulate\Users;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateProfileCommandHandler implements CommandHandler{

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
			$command->user, $command->first_name, $command->last_name
		);

		$this->repository->save($profile);

		$this->dispatchEventsFor($profile);

		return $profile;
	}
}
