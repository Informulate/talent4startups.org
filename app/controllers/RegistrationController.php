<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\RegistrationForm;
use Informulate\Registration\RegisterUserCommand;
use Informulate\Users\Profile;
use Informulate\Core\CommandBus;

class RegistrationController extends BaseController {

	use CommandBus;

	/**
	 * @var RegistrationForm
	 */
	private $registrationForm;

	/**
	 * Constructor
	 *
	 * @param RegistrationForm $registrationForm
	 */
	function __construct(RegistrationForm $registrationForm)
	{
		$this->registrationForm = $registrationForm;

		$this->beforeFilter('guest');
	}


	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$data = Input::all();
		if(!array_key_exists('user_type',$data))
		{
			redirect::route('/');
		}
		return View::make('registration.create');
	}

	/**
	 * Save the user.
	 */
	public function store()
	{
		$data = Input::all();
		if(array_key_exists('submit-registration',$data))
		{
		//if form filled and submitted by user
		$this->registrationForm->validate(Input::all());

		extract(Input::only('username', 'email', 'password','user_type'));

		$user = $this->execute(
			new RegisterUserCommand($username, $email, $password)
		);

		Auth::login($user);
		
		//create user profile and store user_type in profile table	
		
		$profile = new Profile(array('user_type'=>$user_type));		

		$profile = $user->profile()->save($profile);

		Flash::message('Welcome to Talent4Startups');

		return Redirect::to('profile');
		}

		
		return View::make('registration.create')->with('userType',$data['user_type']);
	}
}
