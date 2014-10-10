<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\SignInForm;

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
			return Redirect::intended('');
		}
	}

	public function destroy()
	{
		Auth::logout();
		Flash::message('You have now been logged out');
		return Redirect::home();
	}
}
