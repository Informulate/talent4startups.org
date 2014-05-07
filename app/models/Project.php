<?php

class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

	public function members()
	{
		return $this->belongsToMany('User');
	}

	public function owner()
	{
		return $this->belongsTo('User');
	}

}
