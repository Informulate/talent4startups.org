<?php

use Informulate\Skills\Skill;
use Informulate\Users\User;
use Informulate\Users\UserRepository;

class TalentController extends BaseController
{
	/**
	 * @var UserRepository
	 */
	private $userRepository;

	/**
	 * @param UserRepository $userRepository
	 */
	function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;

		parent::__construct();
	}

	/**
	 * Display a list of active talents
	 *
	 * @return $this
	 */
	public function index()
	{
		if (!Auth::User()) {
			// Temporary lock per request on ticket #111
			return View::make('layouts.partials.login-required')->render();
		}

		$talents = $this->userRepository->findActiveTalents(Input::get('tag'), Input::get('describes'), Input::get('location'));

		if (Request::ajax()) {
			return View::make('talent.list')->with('talents', $talents)->render();
		}

		$describes = Skill::lists('name', 'id');

		return View::make('talent.index')->with('talents', $talents)->with('describes', $describes);
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
