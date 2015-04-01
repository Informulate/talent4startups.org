<?php

use Illuminate\Database\Seeder;
use Informulate\Stages\Stage;

class StageTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$stages = ['Just starting out', 'Some market research done', 'Business plan/model done', 'Landing page done', 'Wireframes done', 'Prototype done', 'Pitched to Investors', 'Generated Revenue'];

		foreach ($stages as $stageName) {
			$stage = Stage::create([
				'name' => $stageName
			]);
			$stage->save();
		}
	}
}
