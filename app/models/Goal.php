<?php

class Goal extends BaseModel
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'goals';
	protected $guarded = ['id'];
	protected static $rules = ['name' => 'required'];

	public function project()
	{
		return $this->belongsTo('Project');
	}

}
