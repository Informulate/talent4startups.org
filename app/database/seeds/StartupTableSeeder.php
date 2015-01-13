<?php

use Cocur\Slugify\Slugify;
use Informulate\Skills\Skill;
use Informulate\Startups\Startup;
use Informulate\Startups\StartupRepository;
use Informulate\Tags\Tag;
use Informulate\Users\User;

class StartupTableSeeder extends Seeder {
	/**
	 * @var StartupRepository
	 */
	private $repository;

	/**
	 * @param StartupRepository $repository
	 */
	function __construct(StartupRepository $repository) {
		$this->repository = $repository;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$faker = Faker\Factory::create();
		$slugify = Slugify::create();
		$users = User::all();
		$tags = Tag::all();
		$skills = Skill::all();

		foreach ($users as $user) {
			foreach (range(1, rand(2, 4)) as $i) {
				$name = $faker->name;

				$startup = Startup::create([
					'name' => $name,
					'description' => $faker->text,
					'url' => $slugify->slugify($name),
					'user_id' => $user->id,
					'published' => true,
				]);

				$this->repository->save($startup);

				$startupTags = [];
				foreach (range(1, rand(2, 4)) as $i) {
					$id = rand(1, (count($tags) - 1));
					$startupTags[] = $id;
				}

				$needs = [];
				foreach (range(1, rand(2, 4)) as $i) {
					$id = rand(1, (count($skills) - 1));
					$needs[] = $id;
				}

				$startup->needs()->attach($needs);
				$startup->tags()->attach($startupTags);

				foreach (range(1, rand(2, 6)) as $i) {
					$id = rand(1, (count($users) - 1));

					if ($startup->owner->id !== $id) {
						$this->repository->addMemberRequest($users[$id], $startup);
						if (rand(0,1)) {
							$this->repository->approveMemberRequest($users[$id], $startup);
						}
					}
				}
			}
		}
	}

}