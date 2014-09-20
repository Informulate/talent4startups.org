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
			exit('I just stopped you getting fired. Love Phil');
		}

		Eloquent::unguard();

		$tables = [
			'users',
			'profiles',
			'projects',
			'project_user',
			'project_tag',
			'tags'
		];

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		foreach($tables as $table) {
			DB::table($table)->truncate();
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$this->call('UserTableSeeder');
		$this->call('ProjectTableSeeder');
	}

}
