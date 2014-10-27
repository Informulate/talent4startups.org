<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\SignInForm;
use Informulate\Users\Profile;
use Informulate\Skills\Skill;

class SessionsController extends BaseController {

	/**
	 * @var SignInForm
	 */
	private $signInForm;

	/**
	 * Constructor
	 *
	 * @param SignInForm $signInForm
	 */
	function __construct(SignInForm $signInForm)
	{
		$this->signInForm = $signInForm;

		$this->beforeFilter('guest', ['except' => 'destroy']);
	}


	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create');
	}

	 
	 /**
	 * Save the user.
	 */
	public function store()
	{
		$formData = Input::only('email', 'password');
		$this->signInForm->validate($formData);

		if (Auth::attempt($formData)) {
			Flash::message('Welcome back to Talent4Startups!');
		    $profile = Auth::user()->profile;
			if(sizeof($profile)>0){
			     //user has created profile
				$talentSkills = Skill::getUserProfileSkills($profile); 
			
				if(count($talentSkills)>0){
				// user has added skills to profile , redirect to projects
				return Redirect::intended('');
				}
			}
			// if profile is null, redirect to profile
			return Redirect::intended('profile');
		}
		//if wrong email/password entered
		return Redirect::to('login')->with('email',$formData['email'])->with('error','Wrong email/password entered.');
	}
	public function destroy()
	{
		Auth::logout();
		Flash::message('You have now been logged out');
		return Redirect::home();
	}
}
