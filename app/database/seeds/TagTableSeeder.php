<?php

use Informulate\Tags\Tag;

class TagTableSeeder extends Seeder
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
			$tag = Tag::create([
				'name' => $faker->domainWord
			]);
			$tag->save();
		}
	}
}
