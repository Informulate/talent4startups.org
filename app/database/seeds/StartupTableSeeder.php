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
				$commitments = ['full-time', 'part-time'];
				foreach (range(1, rand(2, 4)) as $i) {
					$roleId = rand(1, (count($skills) - 1));
                    $needTags = [];
                    foreach (range(1, rand(2, 4)) as $i) {
                        $id = rand(1, (count($tags) - 1));
                        $needTags[] = $id;
                    }
					$needs[] = array(
                        'role' => $roleId,
                        'quantity' => rand(1,10),
                        'skills' => implode(',', $needTags),
						'commitment' => $commitments[rand(0, 1)],
						'desc' => $faker->text,
                    );

                    $this->repository->updateNeeds($startup, $needs);
				}

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
