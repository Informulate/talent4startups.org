<?php

use Faker\Factory as Faker;

class ProjectStageTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (Project::all() as $project) {

			$stageIds = Stage::lists('id');

			foreach(range(1, rand(2, 4)) as $i) {
				DB::table('project_stage')->insert([
					'project_id' => $project->id,
					'stage_id' => $faker->randomElement($stageIds),
					'created_at' => new DateTime,
					'updated_at' => new DateTime,
				]);
			}
		}

	}

}
