<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('Informulate\Users\Profile');
	}
}
