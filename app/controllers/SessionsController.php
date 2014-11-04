<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\SignInForm;
use Informulate\Users\User;
use Informulate\Users\Profile;
use Informulate\Tags\Tag;

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
			$tags = Auth::user()->profile->tags;

			if(is_object($profile) && !empty($profile->first_name) && !empty($profile->last_name) && (is_object($tags) && sizeof($tags)>0)){
			//redirect to home page if profile has First Name, Last Name and Skills
			return Redirect::intended('');
			}
			// if profile is missing, redirect to edit profile page
			return Redirect::intended('profile');
		}
		//if wrong email/password entered
		return Redirect::to('login')->with('email',$formData['email'])->with('error','Wrong email/password entered.');
	}

	/*
	* Login with linked in
	*/
	public function loginWithLinkedin(){
		//DO STUFF HERE
	}

	public function destroy()
	{
		Auth::logout();
		Flash::message('You have now been logged out');
		return Redirect::home();
	}
}
