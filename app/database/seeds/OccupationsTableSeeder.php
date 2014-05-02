<?php

use Faker\Factory as Faker;
use Ivanlemeshev\Laravel4CyrillicSlug\Facades\Slug;

class OccupationsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 30) as $index) {
			$name = $faker->sentence(2);
			$slug = Slug::make($name);

			Occupation::create([
				'name' => $name,
				'slug' => $slug
			]);
		}

	}

}
