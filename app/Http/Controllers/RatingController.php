<?php

namespace App\Http\Controllers;

//use Informulate\Ratings\Commands\RateUserCommand;
use App\Repositories\StartupRepository;

class RatingController extends Controller
{

	/**
	 * @var StartupRepository
	 */
	private $repository;

	/**
	 * @param StartupRepository $repository
	 */
	function __construct(StartupRepository $repository)
	{
		$this->repository = $repository;

		$this->beforeFilter('auth');

		parent::__construct();
	}

	/**
	 * Rate a startup or a member
	 */
	public function rate()
	{
		extract(Input::only('rating', 'rated_id', 'rated_type', 'rated_by_id', 'rated_by_type'));

		$this->execute(
			new RateUserCommand($rating, $rated_id, $rated_type, $rated_by_id, $rated_by_type)
		);
	}
}
