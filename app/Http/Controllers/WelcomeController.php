<?php

namespace App\Http\Controllers;

use App\Repositories\StartupRepository;
use App\Repositories\UserRepository;
use DB, Response, Redirect;
use Illuminate\Http\Request;

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
	 * @param Request $request
	 * @param StartupRepository $startupRepository
	 * @param UserRepository $userRepository
	 * @return Response
	 */
	public function index(Request $request, StartupRepository $startupRepository, UserRepository $userRepository)
	{
		if ($request->has('referral')) {
			$request->session()->put('referral', $request->query('referral'));
		}

		$startups = $startupRepository->allActive(null, null, null, DB::raw('RAND()'), 2);
		$talent = $userRepository->findActiveTalents(null, null, null, DB::raw('RAND()'), 2);

		return view('welcome')->with('startups', $startups)->with('talents', $talent)->with('referrer');
	}

}
