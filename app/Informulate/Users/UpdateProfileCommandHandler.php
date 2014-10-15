<?php namespace Informulate\Users;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Informulate\Skills\Skill;
use Informulate\Users\Upload; 

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
			$command->user, $command->profileInfo
		);	
		$fileName ='';
		//upload profile picture, if your has selected
		if(isset($command->profileInfo['image'])){
		$targetPath = storage_path().'/images/';
		$fileName   = str_random(10).'.'.$command->profileInfo['image']->getClientOriginalName();
		$command->profileInfo['image']->move($targetPath,$fileName);
		}
		$profile->image = $fileName;
		$this->repository->save($profile);
		$this->dispatchEventsFor($profile);
		Profile::find($profile['id'])->skills()->detach();// remove all skills of project
		Skill::newProfileSkills($profile,$command->profileInfo['skills']); //add new skills
		return $profile;
	}
}
