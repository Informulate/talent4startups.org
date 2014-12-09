<?php

use Informulate\Users\Profile;
use Informulate\Users\ProfileRepository;
use Informulate\Users\User;
use Informulate\Users\UserRepository;

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

		for ($i = 0; $i < 100; $i++) {
			$user = User::register($faker->userName, $faker->email, 'password', 'talent');
			$this->userRepository->save($user);
		}

		foreach (User::all() as $currentUser) {
			$profileData = [
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'location' => $faker->city,
				'describe' => $faker->numberBetween(1, 2),
				'about' => $faker->sentence(),
				'facebook' => $faker->userName,
				'linked_in' => $faker->userName,
				'twitter' => $faker->userName,
				'meetup' => $faker->userName,
				'published' => $faker->boolean()
			];

			$profile = Profile::updateProfile($currentUser, $profileData);

			$this->profileRepository->save($profile);
		}
	}
}
