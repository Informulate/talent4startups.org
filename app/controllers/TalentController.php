<?php

use Informulate\Users\User;
use Informulate\Users\UserRepository;

class TalentController extends BaseController {
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
	}

	/**
	 * Display a list of active talents
	 *
	 * @return $this
	 */
	public function index()
	{
		$talents = $this->userRepository->findActiveTalents();

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
