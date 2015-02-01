<?php

use Illuminate\Support\Facades\DB;
use Informulate\Startups\StartupRepository;
use Informulate\Users\UserRepository;

class PagesController extends \BaseController {

	public function home()
	{
		$startupRepository = new StartupRepository;
		$userRepository = new UserRepository();
		$startups = $startupRepository->allActive(null, null, DB::raw('RAND()'), 5);
		$talent = $userRepository->findActiveTalents(null, null, null, DB::raw('RAND()'), 5);

		if (Auth::check()) {
			return View::make('pages.dashboard')
				->with('myStartups', Auth::user()->startups)
				->with('contributions', Auth::user()->contributions)
				->with('startups', $startups)
				->with('talents', $talent);
		}

		return View::make('pages.home')->with('startups', $startups)->with('talents', $talent);
	}
}
