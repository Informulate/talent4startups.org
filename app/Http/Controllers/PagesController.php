<?php

namespace App\Http\Controllers;

use App\Repositories\StartupRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
	public function home(StartupRepository $startupRepository, UserRepository $userRepository)
	{
		$startups = $startupRepository->allActive(null, null, DB::raw('RAND()'), 2);
		$talent = $userRepository->findActiveTalents(null, null, null, DB::raw('RAND()'), 2);

		if (Auth::check()) {
			return Redirect::to('/users/' . Auth::user()->id);
			return view('pages.dashboard')
				->with('myStartups', Auth::user()->startups)
				->with('contributions', Auth::user()->contributions)
				->with('startups', $startups)
				->with('talents', $talent);
		}

		return view('pages.home')->with('startups', $startups)->with('talents', $talent);
	}

	public function missing()
	{
		return Response::view('errors.missing', array(), 404);
	}

	public function launch()
	{
		return Redirect::to('http://www.eventbrite.com/e/talent4startups-launch-party-tickets-15821969938');
	}
}
