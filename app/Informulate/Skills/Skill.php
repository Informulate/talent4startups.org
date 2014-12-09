<?php namespace Informulate\Skills;

use Eloquent;

class Skill extends Eloquent
{
	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'skill_id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('Informulate\Users\Profile');
	}
}
