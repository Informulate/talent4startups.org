<?php

use Faker\Factory as Faker;
use Ivanlemeshev\Laravel4CyrillicSlug\Facades\Slug;

class GoalsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (Project::all() as $project) {

			// Create however many goals for this project
			foreach(range(1, rand(2, 4)) as $i) {
				$name = $faker->sentence(1);
				$slug = Slug::make($name);

				Goal::create([
					'name'          => $name,
					'slug'          => $slug,
					'project_id'    => $project->id,
					'description'   => $faker->sentence(3),
					'weight'        => rand(1,20),
				]);
			}
		}
	}
}
