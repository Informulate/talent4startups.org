<?php

class PagesController extends \BaseController {

	public function home()
	{
		if (Auth::check()) {
			return View::make('pages.dashboard');
		}

		return View::make('pages.home');
	}
}
