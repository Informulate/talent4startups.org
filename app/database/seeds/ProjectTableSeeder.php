<?php

use Cocur\Slugify\Slugify;
use Informulate\Projects\Project;
use Informulate\Projects\ProjectRepository;
use Informulate\Users\User;

class ProjectTableSeeder extends Seeder {
	/**
	 * @var ProjectRepository
	 */
	private $repository;

	/**
	 * @param ProjectRepository $repository
	 */
	function __construct(ProjectRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		$slugify = Slugify::create();
		$users = User::all();

		foreach ($users as $user) {
			foreach (range(1, rand(2, 4)) as $i) {
				$name = $faker->name;

				$project = Project::create([
					'name' => $name,
					'description' => $faker->text,
					'url' => $slugify->slugify($name),
					'user_id' => $user->id,
				]);

				$this->repository->save($project);

				foreach (range(1, rand(2, 6)) as $i) {
					$id = rand(1, (count($users) - 1));

					if ($project->owner->id !== $id) {
						$this->repository->addMemberRequest($users[$id], $project);
					}
				}
			}
		}
	}

}
