<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function members()
	{
		return $this->hasMany('App\Model\User');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function posts()
	{
		return $this->hasMany('App\Model\Post');
	}
}
