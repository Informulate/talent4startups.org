<?php

namespace Informulate\Transformers;

class SkillSetsTransformer extends Transformer {

	/**
	 * @var TagsTransformer
	 */
	protected $tagsTransformer;

	function __construct()
	{
		$this->tagsTransformer = new TagsTransformer();
	}

	/**
	 * @param $skillSet
	 * @return array
	 */
	public function transform($skillSet)
	{
		return [
			'name' => $skillSet['skill']['name'],
			'slug' => $skillSet['skill']['slug'],
			'interest' => (bool) $skillSet['interest'],
			'tags' => $this->tagsTransformer->transformCollection($skillSet['tags']->toArray()),
			'created_at' => $skillSet['created_at'],
			'updated_at' => $skillSet['updated_at']
		];
	}

}
