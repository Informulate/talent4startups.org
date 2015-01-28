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
		$skills = ['Designer', 'Developer', 'Engineer', 'Musician', 'Visual Artist', 'Filmmaker', 'Writer', 'Project Manager', 'Other'];

		foreach ($skills as $skillName) {
			$skill = Skill::create([
				'name' => $skillName
			]);
			$skill->save();
		}
	}
}
