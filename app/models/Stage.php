<?php

class Stage extends \Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'stages';
	protected $guarded = ['id'];
	protected static $rules = ['name' => 'required'];

	public function project()
	{
		return $this->belongsToMany('Project');
	}
}