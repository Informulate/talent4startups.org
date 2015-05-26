<?php

namespace App\Repositories;

use App\Events\StartupRated;
use App\Events\UserRated;
use App\Models\Rating;
use Event;

class RatingRepository
{

	/**
	 * Saves the rating
	 *
	 * @param Rating $rating
	 * @return bool
	 */
	public function save(Rating $rating)
	{
		return $rating->save();
	}

	/**
	 * @param $rating
	 * @param $rated_id
	 * @param $rated_type
	 * @param $rated_by_id
	 * @param $rated_by_type
	 * @return static
	 */
	public function create($rating, $rated_id, $rated_type, $rated_by_id, $rated_by_type)
	{
		$rating = new Rating(compact('rating', 'rated_id', 'rated_type', 'rated_by_id', 'rated_by_type'));

		$this->raiseEvents($rated_id, $rated_type, $rated_by_id);

		return $rating;
	}

	/**
	 * @param $rating
	 * @param $rated_id
	 * @param $rated_type
	 * @param $rated_by_id
	 * @param $rated_by_type
	 * @return Rating
	 */
	public function update($rating, $rated_id, $rated_type, $rated_by_id, $rated_by_type)
	{
		$current = Rating::where('rated_type', '=', $rated_type)
			->where('rated_id', $rated_id)
			->where('rated_by_type', $rated_by_type)
			->where('rated_by_id', $rated_by_id)
			->first();

		if ($current) {
			$current->rating = $rating;

			$this->raiseEvents($rated_id, $rated_type, $rated_by_id);
		}

		return $current;
	}

	/**
	 * @param $rated_id
	 * @param $rated_type
	 * @param $rated_by_id
	 */
	private function raiseEvents($rated_id, $rated_type, $rated_by_id)
	{
		switch ($rated_type) {
			case '\\App\\Models\\Startup':
				Event::fire('App.Events.StartupRated', [new StartupRated($rated_id, $rated_by_id)]);
				break;
			default:
				Event::fire('App.Events.UserRated', [new UserRated($rated_id, $rated_by_id)]);
				break;
		}
	}
}
