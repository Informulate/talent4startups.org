<?php

use Faker\Factory as Faker;

class ProjectsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 30) as $index) {
			Project::create([
				'name' => $faker->sentence(2),
				'slug' => $faker->word
			]);
		}

	}

}
