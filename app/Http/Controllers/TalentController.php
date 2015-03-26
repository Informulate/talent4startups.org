<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TalentController extends Controller
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
		$this->middleware('auth');

//		parent::__construct();
	}

	/**
	 * Display a list of active talents
	 *
	 * @return $this
	 */
	public function index()
	{
		$talents = $this->userRepository->findActiveTalents(Input::get('tag'), Input::get('describes'), Input::get('location'));
		$describes = Skill::lists('name', 'id');

		return view('talent.index')->with('talents', $talents)->with('describes', $describes);
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
