<?php

namespace Informulate\Transformers;

class SkillsTransformer extends Transformer {

	/**
	 * @param $skill
	 * @return array
	 */
	public function transform($skill)
	{
		return [
			'name' => $skill['name'],
			'slug' => $skill['slug'],
			'created_at' => $skill['created_at'],
			'updated_at' => $skill['updated_at']
		];
	}

}
