<?php

class PagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /pages
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::guest()) {
			return View::make('index');
		}

		return View::make('dashboard');
	}

	public function projects()
	{
		return View::make('projects');
	}

}
