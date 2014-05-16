<?php

use Faker\Factory as Faker;
use Ivanlemeshev\Laravel4CyrillicSlug\Facades\Slug;

class SkillsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 30) as $index) {
			$name = $faker->sentence(2);
			$slug = Slug::make($name);

			Skill::create([
				'name' => $name,
				'slug' => $slug
			]);
		}

	}

}
