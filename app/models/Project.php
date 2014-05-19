<?php

class Project extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	protected $guarded = ['id'];
	protected static $rules = ['name' => 'required'];

	public function members()
	{
		return $this->belongsToMany('User');
	}

	public function owner()
	{
		return $this->belongsTo('User');
	}
	public function stages()
	{
		return $this->belongsToMany('Stage');
	}


}
