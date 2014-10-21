<?php

use Informulate\Users\User;

class TalentController extends BaseController {

	/**
	 * Display a list of active talents
	 *
	 * @return $this
	 */
	public function index()
	{
		$talents = User::paginate(16);

		return View::make('talent.index')->with('talents', $talents);
	}

	/**
	 * Display a talent
	 *
	 * @param $talent
	 * @return \Illuminate\View\View
	 */
	public function show($talent)
	{
		$talent = User::where('username', '=', $talent)->firstOrFail();

		return View::make('talent.show')->with('talent', $talent);;
	}
}
