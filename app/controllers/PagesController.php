<?php

class PagesController extends \BaseController {

	public function home()
	{
		if (Auth::check()) {
			return View::make('pages.dashboard')->with('myProjects', Auth::user()->projects);
		}

		return View::make('pages.home');
	}
}
