<?php

namespace Informulate\Transformers;


abstract class Transformer {

	/**
	 * @param $items
	 * @return array
	 */
	public function transformCollection($items)
	{
		return array_map([$this, 'transform'], $items);
	}

	/**
	 * @param $item
	 * @return mixed
	 */
	public abstract function transform($item);
} 
