<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\RegistrationForm;
use Informulate\Registration\Commands\RegisterUserCommand;
use Informulate\Users\Commands\UpdateProfileCommand;
use Informulate\Users\User;
use Informulate\Core\CommandBus;

class RegistrationController extends BaseController
{
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
		$type = Input::get('type');

		if (is_null($type)) {
			return View::make('registration.select_type');
		}

		return View::make('registration.create')->with('type', $type);
	}

	/**
	 * Save the user.
	 */
	public function store()
	{
		$this->registrationForm->validate(Input::all());

		extract(Input::only('username', 'email', 'password', 'type'));

		$user = $this->execute(
			new RegisterUserCommand($username, $email, $password, $type)
		);

		Auth::login($user);

		Flash::message('Welcome to Talent4Startups');

		return Redirect::to('profile');
	}
}
