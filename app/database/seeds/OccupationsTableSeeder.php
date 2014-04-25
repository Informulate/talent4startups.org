<?php

use Faker\Factory as Faker;

class OccupationsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 30) as $index) {
			Occupation::create([
				'name' => $faker->sentence(2),
				'slug' => $faker->word
			]);
		}

	}

}
