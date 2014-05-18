<?php

use Faker\Factory as Faker;

class SkillSetTagsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach (SkillSet::all() as $skillSet) {

			$tagIds = Tag::lists('id');

			foreach(range(1, rand(2, 4)) as $i) {
				DB::table('skill_set_tag')->insert([
					'skill_set_id' => $skillSet->id,
					'tag_id' => $faker->randomElement($tagIds),
				]);
			}
		}

	}

}
