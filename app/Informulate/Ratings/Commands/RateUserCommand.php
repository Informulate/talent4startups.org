<?php namespace Informulate\Ratings\Commands;

class RateUserCommand
{
	/**
	 * @var float
	 */
	public $rating;
	/**
	 * @var integer
	 */
	public $rated_id;
	/**
	 * @var string
	 */
	public $rated_type;
	/**
	 * @var integer
	 */
	public $rated_by_id;
	/**
	 * @var string
	 */
	public $rated_by_type;

	/**
	 * @param $rating
	 * @param $rated_id
	 * @param $rated_type
	 * @param $rated_by_id
	 * @param $rated_by_type
	 */
	function __construct($rating, $rated_id, $rated_type, $rated_by_id, $rated_by_type)
	{
		$this->rating = $rating;
		$this->rated_id = $rated_id;
		$this->rated_type = $rated_type;
		$this->rated_by_id = $rated_by_id;
		$this->rated_by_type = $rated_by_type;
	}
}
