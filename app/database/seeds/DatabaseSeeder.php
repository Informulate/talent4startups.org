<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if (App::environment() === 'production') {
			exit('I just stopped you getting fired... do not run this in production. Love jesusOmar');
		}

		Eloquent::unguard();

		$tables = [
			'contact_methods',
			'users',
			'skills',
			'projects',
			'tags',
			'needs',
			'skill_sets',
			'project_user',
			'skill_set_tag',
			'stages',
			'project_stage'
		];

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$this->call('ContactMethodsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('SkillsTableSeeder');
		$this->call('ProjectsTableSeeder');
		$this->call('TagsTableSeeder');
		$this->call('SkillSetsTableSeeder');
		$this->call('SkillSetTagsTableSeeder');
		$this->call('StagesTableSeeder');
		$this->call('ProjectStageTableSeeder');
	}

}
