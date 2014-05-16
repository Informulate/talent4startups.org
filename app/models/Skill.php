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

	public function skillSets()
	{
		return $this->hasMany('SkillSet');
	}

}
