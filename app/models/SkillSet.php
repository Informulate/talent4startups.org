<?php

class SkillSet extends BaseModel
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'skill_sets';
	protected $guarded = ['id'];
	protected static $rules = ['name' => 'required'];

	public function users()
	{
		return $this->belongsTo('User');
	}

	public function skill()
	{
		return $this->belongsTo('Skill');
	}

	public function tags()
	{
		return $this->belongsToMany('Tag');
	}

	/**
	 * @return array
	 */
	public static function getValidations()
	{
		return self::$rules;
	}

}
