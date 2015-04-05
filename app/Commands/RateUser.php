<?php namespace App\Commands;

use App\Models\User;
use App\Repositories\RatingRepository;
use App\Repositories\ThreadRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class RateUser extends Command implements SelfHandling {

	private $rating, $rated_id,$rated_type, $rated_by_id, $rated_by_type;

	/**
	 * Create a new command instance.
	 *
	 * @param $rating
	 * @param $rated_id
	 * @param $rated_type
	 * @param $rated_by_id
	 * @param $rated_by_type
	 */
	public function __construct($rating, $rated_id, $rated_type, $rated_by_id, $rated_by_type)
	{
		$this->rating = $rating;
		$this->rated_id = $rated_id;
		$this->rated_type = $rated_type;
		$this->rated_by_id = $rated_by_id;
		$this->rated_by_type = $rated_by_type;
	}

	/**
	 * Execute the command.
	 *
	 * @param RatingRepository $repository
	 * @return static
	 */
	public function handle(RatingRepository $repository)
	{
		$this->prepareMorphFields();

		$rating = $repository->update($this->rating, $this->rated_id, $this->rated_type, $this->rated_by_id, $this->rated_by_type);

		if (! $rating) {
			$rating = $repository->create($this->rating, $this->rated_id, $this->rated_type, $this->rated_by_id, $this->rated_by_type);
		}

		$repository->save($rating);

		return $rating;
	}

	/**
	 * Prepare Morph Fileds
	 */
	private function prepareMorphFields()
	{
		switch ($this->rated_type) {
			case 'startup':
				$this->rated_type = 'App\\Models\\Startup';
				$this->rated_by_type = 'App\\Models\\User';
				break;
			default:
				$this->rated_type = 'App\\Models\\User';
				$this->rated_by_type = 'App\\Models\\Startup';
				ThreadRepository::notification('talent.rating.talent', User::find($this->rated_id), array());
				break;
		}
	}

}
