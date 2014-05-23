<?php

class StagesTableSeeder extends Seeder {

	public function run()
	{
		Stage::create([
			'name' => "Market research",
			'slug' => "market-research",
			'description' => "Market research: market sizing, competitive analysis, minimum viable product (MVP), customer development, etc."
		]);
		Stage::create([
			'name' => "Business plan",
			'slug' => "business-plan",
			'description' => "Developing and validating a business plan."		]);
		Stage::create([
			'name' => "Landing page",
			'slug' => "landing-page",
			'description' => "A website providing information and announcements via a landing page"		]);
		Stage::create([
			'name' => "Wireframes",
			'slug' => "wireframes",
			'description' => "A graphic mockup of our site, application, api, etc."		]);
		Stage::create([
			'name' => "Prototype",
			'slug' => "prototype",
			'description' => "A functioning and testable application or api used for demonstration and education purposes."		]);
		Stage::create([
			'name' => "Pitched to investors",
			'slug' => "pitched-to-investors",
			'description' => "Business plan has been pitched to investors for the purpose of raising funding."		]);
		Stage::create([
			'name' => "Generated revenue",
			'slug' => "generated-revenue",
			'description' => "An application, api, or set of services currently generating revenue."		]);

	}

}
