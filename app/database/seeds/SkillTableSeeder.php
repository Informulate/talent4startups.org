<?php

use Informulate\Skills\Skill;

class SkillTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		for ($i = 0; $i < 100; $i++) {
			$skill = Skill::create([
				'name' => $faker->domainWord
			]);
			$skill->save();
		}
	}
}
