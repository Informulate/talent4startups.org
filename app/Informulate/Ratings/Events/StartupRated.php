<?php namespace Informulate\Ratings\Events;

class StartupRated
{
	/**
	 * @var integer
	 */
	private $rated_id;
	/**
	 * @var integer
	 */
	private $rated_by_id;

	/**
	 * @param $rated_id
	 * @param $rated_by_id
	 */
	function __construct($rated_id, $rated_by_id)
	{
		$this->rated_id = $rated_id;
		$this->rated_by_id = $rated_by_id;
	}
}
