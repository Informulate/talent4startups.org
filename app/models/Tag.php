<?php

class Tag extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	public function skillSets()
	{
		return $this->belongsToMany('SkillSet');
	}

	public function users()
	{
		return $this->hasManyThrough('SkillSet', 'User');
	}

}
