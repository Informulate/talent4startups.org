<?php

use Informulate\Skills\Skill;
use Informulate\Tags\Tag;
use Informulate\Users\Commands\UpdateProfileCommand;
use Informulate\Users\ProfileRepository;
use Informulate\Users\User;
use Informulate\Users\UserRepository;
use Informulate\Core\CommandBus;

class UserTableSeeder extends Seeder
{
	use CommandBus;

	/**
	 * @var UserRepository
	 */
	private $userRepository;
	/**
	 * @var ProfileRepository
	 */
	private $profileRepository;

	/**
	 * @param UserRepository $userRepository
	 * @param ProfileRepository $profileRepository
	 */
	function __construct(UserRepository $userRepository, ProfileRepository $profileRepository)
	{
		$this->userRepository = $userRepository;
		$this->profileRepository = $profileRepository;
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

		for ($i = 0; $i < 100; $i++) {
			$user = User::register($faker->userName, $faker->email, 'password', 'talent');
			$this->userRepository->save($user);

			$profileData = [
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'location' => $faker->city,
				'describe' => $faker->numberBetween(1, count($skills) - 1),
				'about' => $faker->sentence(),
				'facebook' => $faker->userName,
				'linked_in' => $faker->userName,
				'twitter' => $faker->userName,
				'meetup' => $faker->userName,
				'published' => $faker->boolean()
			];

			$skills = '';
			foreach (range(1, rand(2, 4)) as $i) {
				$id = rand(1, (count($tags) - 1));
				$skills .= $tags[$id]->name . ",";
			}

			$profileData['skills'] = $skills;

			$this->execute(
				new UpdateProfileCommand($user, $profileData)
			);
		}
	}
}
