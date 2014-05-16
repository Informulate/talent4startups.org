<?php

class Skill extends BaseModel
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'skills';
	protected $guarded = ['id'];
	protected static $rules = ['name' => 'required'];

	public function skillSets()
	{
		return $this->hasMany('SkillSet');
	}

}
