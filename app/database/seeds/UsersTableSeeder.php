<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 30) as $index) {
			User::create([
				'username'              => $faker->word,
				'email'                 => $faker->email,
				'password'              => 'password',
				'password_confirmation' => 'password',
				'confirmation_code'     => $faker->word,
				'confirmed'             => true,
			]);
		}

	}

}
