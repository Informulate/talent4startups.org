<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if (App::environment() === 'production') {
			exit('I just stopped you getting fired. Love Jesus');
		}

		Eloquent::unguard();

		$tables = [
			'users',
			'profiles',
			'profile_tag',
			'startups',
			'startup_user',
			'startup_tag',
			'tags',
			'stages',
			'skills',
			'skill_startup',
			'password_reminders',
            'messages',
            'participants',
            'threads'
		];

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$this->call('TagTableSeeder');
		$this->call('SkillTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('StartupTableSeeder');
        $this->call('MessageTableSeeder');
	}

}
