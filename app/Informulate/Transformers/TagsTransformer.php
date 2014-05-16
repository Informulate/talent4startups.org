<?php

namespace Informulate\Transformers;

class TagsTransformer extends Transformer {

	/**
	 * @param $tags
	 * @return array
	 */
	public function transform($tags)
	{
		return [
			'name' => $tags['name'],
			'slug' => $tags['slug'],
			'created_at' => $tags['created_at'],
			'updated_at' => $tags['updated_at']
		];
	}

}
