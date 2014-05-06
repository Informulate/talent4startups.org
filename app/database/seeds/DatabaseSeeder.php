<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		User::truncate();
		Occupation::truncate();
		Project::truncate();
		Tag::truncate();
		DB::table('occupation_user')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$this->call('UsersTableSeeder');
		$this->call('OccupationsTableSeeder');
		$this->call('ProjectsTableSeeder');
		$this->call('TagsTableSeeder');
		$this->call('OccupationUsersTableSeeder');
	}

}
