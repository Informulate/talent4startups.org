<?php

class PagesController extends \BaseController {

	public function home()
	{
		if (Auth::check()) {
			return View::make('pages.dashboard')->with('myStartups', Auth::user()->startups)->with('contributions', Auth::user()->contributions);
		}

		return View::make('pages.home');
	}
}
