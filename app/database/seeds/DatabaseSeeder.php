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

		Occupation::truncate();
		$this->call('OccupationsTableSeeder');
	}

}
