<?php

use Faker\Factory as Faker;

class OccupationUsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$occupationIds = Occupation::lists('id');
		$userIds = User::lists('id');

		foreach (range(1, 40) as $index) {
			DB::table('occupation_user')->insert(
				[
					'user_id' => $faker->randomElement($userIds),
					'occupation_id' => $faker->randomElement($occupationIds),
					'interest' => $faker->boolean(),
					'created_at' => $faker->date(),
					'updated_at' => $faker->date()
				]
			);
		}

	}

}
