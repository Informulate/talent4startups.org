<?php

use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 30) as $index) {
			Tag::create([
				'name' => $faker->sentence(2),
				'slug' => $faker->word
			]);
		}

	}

}
