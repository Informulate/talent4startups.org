<?php

use Illuminate\Database\Eloquent\Collection;

class BaseModel extends Eloquent {

	/**
	 * Find a model by its primary key or by its slug.
	 *
	 * @param  mixed  $id
	 * @param  array  $columns
	 * @return \Illuminate\Database\Eloquent\Model|Collection|static
	 */
	public static function findByIdOrSlug($id, $columns = array('*'))
	{
		if (is_array($id) && empty($id)) return new Collection;

		$instance = new static;

		return $instance->newQuery()->where('id', '=', $id)->orWhere('slug', '=', $id)->first($columns);
	}

}
