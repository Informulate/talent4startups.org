<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'type', 'message', 'required'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function users()
	{
		return $this->hasMany('App\Models\User');
	}

}
