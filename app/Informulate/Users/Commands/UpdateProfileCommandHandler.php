<?php namespace Informulate\Users\Commands;

use Informulate\Users\Profile;
use Informulate\Users\ProfileRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Informulate\Tags\Tag;
//use Informulate\Users\Upload;

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
		$this->dispatchEventsFor($profile);

		// TODO: I have to find a better location for this --jesusOmar
		$profile->tags()->detach();// remove all skills of project
		Tag::newProfileTags($profile, $command->profileInfo['skills']); //add new skills

		return $profile;
	}
}
