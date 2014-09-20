<?php

use Informulate\Users\Profile;
use Informulate\Users\ProfileRepository;
use Informulate\Users\User;
use Informulate\Users\UserRepository;

class UserTableSeeder extends Seeder {
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
			$user = User::register($faker->userName, $faker->email, 'password');
			$this->userRepository->save($user);
		}

		foreach(User::all() as $currentUser) {
			$profile = Profile::updateProfile($currentUser, $faker->firstName, $faker->lastName);
			$this->profileRepository->save($profile);
		}
	}

}
