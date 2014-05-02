<?php

class Occupation extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'occupations';
	protected $guarded = ['id'];

	public function users()
	{
		return $this->belongsToMany('User');
	}

}
