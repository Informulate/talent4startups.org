<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Commander\Events\EventGenerator;

class Rating extends Model
{

    /**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['rating', 'rated_id', 'rated_type', 'rated_by_id', 'rated_by_type'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function rated()
	{
		return $this->morphTo();
	}
}
