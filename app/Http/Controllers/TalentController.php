<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Models\Skill;
use Input;

class TalentController extends Controller
{
	/**
	 *
	 */
	function __construct()
	{
		$this->middleware('auth', ['except' => ['index', 'show']]);
		$this->middleware('profile.complete');
	}

	/**
	 * Display a list of active talents
	 *
	 * @param UserRepository $userRepository
	 * @return $this
	 */
	public function index(UserRepository $userRepository)
	{
		$talents = $userRepository->findActiveTalents(Input::get('tag'), Input::get('describes'), Input::get('location'), null, 12, Input::get('professions'));
		$describes = Skill::lists('name', 'id');
		$professions = Profession::lists('name', 'id');

		return view('talent.index')->with('talents', $talents)->with('describes', $describes)->with('professions', $professions);
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

		return view('talent.show')->with('talent', $talent);;
	}
}
