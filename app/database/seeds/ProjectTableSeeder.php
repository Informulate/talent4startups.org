<?php

class ProjectTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		 
		for ($i = 0; $i < 500; $i++)
		{
		  $user = Project::create(array(
		    'name' => $faker->name,
		    'description' => $faker->text
		  ));
		}
	}

}
