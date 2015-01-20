<?php namespace Informulate\Ratings;

use Eloquent;
use Laracasts\Commander\Events\EventGenerator;

class Rating extends Eloquent
{
	use EventGenerator;

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
