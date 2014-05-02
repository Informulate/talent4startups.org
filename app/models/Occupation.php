<?php

class Occupation extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'occupations';
	protected $guarded = ['id'];
	protected static $rules = ['name' => 'required'];

	public function users()
	{
		return $this->belongsToMany('User');
	}

	/**
	 * @return array
	 */
	public static function getValidations()
	{
		return self::$rules;
	}

}
