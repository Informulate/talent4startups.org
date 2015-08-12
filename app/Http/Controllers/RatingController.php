<?php

namespace App\Http\Controllers;

use App\Commands\RateUser;
use Input;

class RatingController extends Controller
{

	function __construct()
	{
		$this->beforeFilter('auth');
		$this->middleware('profile.complete');
		$this->middleware('blocked.by.announcement');
	}

	/**
	 * Rate a startup or a member
	 */
	public function rate()
	{
		extract(Input::only('rating', 'rated_id', 'rated_type', 'rated_by_id', 'rated_by_type'));

		$this->dispatch(new RateUser($rating, $rated_id, $rated_type, $rated_by_id, $rated_by_type));
	}
}
