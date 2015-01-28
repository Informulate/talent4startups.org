<?php namespace Informulate\Ratings;

use Informulate\Ratings\Events\StartupRated;
use Informulate\Ratings\Events\UserRated;
use Laracasts\Commander\Events\EventGenerator;

class RatingRepository
{
	use EventGenerator;

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

		switch ($rated_type) {
			case '\\Informulate\\Startups\\Startup':
				$rating->raise(new StartupRated($rated_id, $rated_by_id));
				break;
			default:
				$rating->raise(new UserRated($rated_id, $rated_by_id));
				break;
		}

		return $rating;
	}

	/**
	 * @param $rating
	 * @param $rated_id
	 * @param $rated_type
	 * @param $rated_by_id
	 * @param $rated_by_type
	 * @return \Illuminate\Database\Eloquent\Model|null|static
	 */
	public function update($rating, $rated_id, $rated_type, $rated_by_id, $rated_by_type)
	{
		$current = Rating::where('rated_type', '=', $rated_type)
			->where('rated_id', $rated_id)
			->where('rated_by_type', $rated_by_type)
			->where('rated_by_id', $rated_by_id)
			->first()
		;

		if ($current) {
			$current->rating = $rating;

			switch ($rated_type) {
				case '\\Informulate\\Startups\\Startup':
					$current->raise(new StartupRated($rated_id, $rated_by_id));
					break;
				default:
					$current->raise(new UserRated($rated_id, $rated_by_id));
					break;
			}
		}

		return $current;
	}
}
