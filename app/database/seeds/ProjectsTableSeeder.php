<?php

use Faker\Factory as Faker;
use Ivanlemeshev\Laravel4CyrillicSlug\Facades\Slug;

class ProjectsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (User::all() as $user) {

			// Create however many projects for this user
			foreach(range(1, rand(2, 4)) as $i) {
				$name = $faker->sentence(2);
				$slug = Slug::make($name);

				Project::create([
					'name' => $name,
					'slug' => $slug,
					'owner_id' => $user->id
				]);
			}
		}

	}

}
