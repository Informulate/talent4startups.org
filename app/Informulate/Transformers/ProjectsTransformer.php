<?php

namespace Informulate\Transformers;

class ProjectsTransformer extends Transformer {

	/**
	 * @param $project
	 * @return array
	 */
	public function transform($project)
	{
		return [
			'name' => $project['name'],
			'slug' => $project['slug'],
			'created_at' => $project['created_at'],
			'updated_at' => $project['updated_at']
		];
	}

} 
