<?php

namespace Informulate\Transformers;

class ProjectsTransformer extends Transformer {

	/**
	 * @var UsersTransformer
	 */
	protected $userTransformer;

	function __construct()
	{
		$this->userTransformer = new UsersTransformer();
	}

	/**
	 * @param $project
	 * @return array
	 */
	public function transform($project)
	{
		return [
			'name' => $project['name'],
			'slug' => $project['slug'],
			'owner' => $this->userTransformer->transform($project['owner']),
			'created_at' => $project['created_at'],
			'updated_at' => $project['updated_at']
		];
	}

} 
