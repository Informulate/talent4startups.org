<?php namespace Informulate\Tags;

use Eloquent;

class Tag extends Eloquent
{

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['tag_id'];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function startups()
	{
		return $this->belongsToMany('Informulate\Startups\Startup');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('Informulate\Users\Profile');
	}
}
