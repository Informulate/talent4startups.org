<?php

namespace App\Http\Controllers;

use App\Repositories\StartupRepository;
use App\Repositories\UserRepository;
use DB, Response, Redirect;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @param StartupRepository $startupRepository
	 * @param UserRepository $userRepository
	 * @return Response
	 */
	public function index(StartupRepository $startupRepository, UserRepository $userRepository)
	{
		if (array_key_exists('HTTP_REFERER', $_SERVER) and $_SERVER['HTTP_REFERER'] == 't4s.us') {
			return Redirect::to('/oix');
		}

		$startups = $startupRepository->allActive(null, null, null, DB::raw('RAND()'), 2);
		$talent = $userRepository->findActiveTalents(null, null, null, DB::raw('RAND()'), 2);

		return view('welcome')->with('startups', $startups)->with('talents', $talent);
	}

}
