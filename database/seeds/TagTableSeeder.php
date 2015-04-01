<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

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
