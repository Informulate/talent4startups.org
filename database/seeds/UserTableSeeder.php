<?php


use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Contracts\Bus\Dispatcher;
use App\Commands\UpdateProfile;

class UserTableSeeder extends Seeder
{
	/**
	 * @var UserRepository
	 */
	private $userRepository;
	/**
	 * @var ProfileRepository
	 */
	private $profileRepository;
	/**
	 * @var Dispatcher
	 */
	private $dispatcher;

	/**
	 * @param UserRepository $userRepository
	 * @param ProfileRepository $profileRepository
	 */
	function __construct(UserRepository $userRepository, ProfileRepository $profileRepository, Dispatcher $dispatcher)
	{
		$this->userRepository = $userRepository;
		$this->profileRepository = $profileRepository;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		$tags = Tag::all();
		$skills = Skill::all();

		for ($i = 0; $i < 50; $i++) {
			$user = User::register($faker->firstName, $faker->lastName, $faker->unique()->userName, $faker->unique()->safeEmail, bcrypt('password'), 'talent');
			$this->userRepository->save($user);

			$profileData = [
				'location' => $faker->city,
				'describe' => $faker->numberBetween(1, count($skills) - 1),
				'about' => $faker->sentence(),
				'facebook' => $faker->userName,
				'linked_in' => $faker->userName,
				'twitter' => $faker->userName,
				'meetup' => $faker->userName,
				'published' => $faker->boolean()
			];

			$userSkills = '';
			foreach (range(1, rand(2, 4)) as $x) {
				$id = rand(1, (count($tags) - 1));
				$userSkills .= $tags[$id]->name . ",";
			}

			$profileData['skills'] = $userSkills;

			$this->dispatcher->dispatch(
				new UpdateProfile($user, $profileData)
			);

		}
	}
}
