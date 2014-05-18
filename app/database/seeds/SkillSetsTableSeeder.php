<?php

use Faker\Factory as Faker;

class SkillSetsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$skillIds = Skill::lists('id');
		$userIds = User::lists('id');

		foreach (range(1, 40) as $index) {
			DB::table('skill_sets')->insert(
				[
					'user_id' => $faker->randomElement($userIds),
					'skill_id' => $faker->randomElement($skillIds),
					'interest' => $faker->boolean(),
					'created_at' => $faker->date(),
					'updated_at' => $faker->date()
				]
			);
		}

	}

}
