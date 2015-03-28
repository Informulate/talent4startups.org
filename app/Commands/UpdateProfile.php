<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Profile;
use App\Models\Startup;
use App\Models\User;
use App\Repositories\ProfileRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateProfile extends Command implements SelfHandling {

	protected $user, $data;

	/**
	 * Create a new command instance.
	 *
	 * @param User $user
	 * @param $data
	 */
	public function __construct(User $user, $data)
	{
		$this->user = $user;
		$this->data = $data;
	}

	/**
	 * Execute the command.
	 *
	 * @param ProfileRepository $repository
	 * @return Startup
	 */
	public function handle(ProfileRepository $repository)
	{
		$profile = Profile::updateProfile(
			$this->user, $this->data
		);

		$repository->save($profile);

		if (array_key_exists('skills', $this->data)) {
			$repository->updateSkills($profile, $this->data['skills']);
		}

		if (array_key_exists('image', $this->data) and !empty($this->data['image'])) {
			$repository->updateImage($profile);
		}

		return $profile;
	}
}
