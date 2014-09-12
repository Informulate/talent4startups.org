<?php

class PagesController extends \BaseController {

	public function home()
	{
		if (Auth::check()) {
			$myProjects = Project::myProjects();

			return View::make('pages.dashboard')->with('myProjects', $myProjects);
		}

		return View::make('pages.home');
	}
}
