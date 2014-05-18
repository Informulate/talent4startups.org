<?php

class BaseModel extends Eloquent {

	protected static $rules = [];

	/**
	 * @return array
	 */
	public static function getValidations()
	{
		return self::$rules;
	}

}
