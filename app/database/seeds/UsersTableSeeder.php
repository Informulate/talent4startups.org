<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 30) as $index) {
			$gender = (rand()&1) ? 'male' : 'female';
			User::create([
				'username'              => $faker->word,
				'email'                 => $faker->email,
				'password'              => 'password',
				'password_confirmation' => 'password',
				'confirmation_code'     => $faker->word,
				'confirmed'             => true,
				'first_name'            => $faker->firstName($gender),
				'last_name'             => $faker->lastName,
				'address'               => $faker->streetAddress.",".
											$faker->city.",".
											$faker->state.",".
											$faker->postcode,
				'address_public'        => rand()&1,
				'phone_number'          => $faker->phoneNumber,
				'phone_number_public'   => rand()&1,
				'github_username'       => $faker->word,
				'twitter_username'      => "@".$faker->word,
				'linkedin_username'     => $faker->word,
				'contact_method_id'  => rand(1,5),
			]);
		}

	}

}
