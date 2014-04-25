<?php

class Occupation extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'occupations';

	public function users()
	{
		return $this->belongsToMany('User');
	}

}
