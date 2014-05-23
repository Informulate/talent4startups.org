<?php

class ContactMethodsTableSeeder extends Seeder {

	public function run()
	{
		ContactMethod::create([
			'name' => "Email",
			'slug' => "email",
		]);
		ContactMethod::create([
			'name' => "Phone",
			'slug' => "phone",
		]);
		ContactMethod::create([
			'name' => "Github account",
			'slug' => "github-account",
		]);
		ContactMethod::create([
			'name' => "Twitter account",
			'slug' => "twitter-account",
		]);
		ContactMethod::create([
			'name' => "LinkedIn account",
			'slug' => "linkedin-account",
		]);
	}

}
