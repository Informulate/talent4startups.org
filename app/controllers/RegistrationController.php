<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\RegistrationForm;
use Informulate\Registration\Commands\RegisterUserCommand;
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

	/*
	* Register user through Linked-in
	*/

	public function registerWithLinkedin()
	{
		// get data from input
		$code = Input::get('code');
		$linkedinService = OAuth::consumer('Linkedin');

		if (!empty($code)) {
			// This was a callback request from linkedin, get the token
			$token = $linkedinService->requestAccessToken($code);
			// Send a request with it. Please note that XML is the default format.
			$result = json_decode($linkedinService->request('/people/~?format=json'), true);
			$email = json_decode($linkedinService->request('/people/~/email-address?format=json'), true);

			$user = User::where('email', '=', $email)->first();
			if (sizeof($user) == 0) {
				//insert new user in db
				$user = new User;
				$user->email = $email;
				$user->save();

				//create user profile and store user_type in profile table
				//$profile = new Profile(array('user_type' => Session::get('userType'), 'active' => 1, 'first_name' => $result['firstName'], 'last_name' => $result['lastName']));
				//$profile = $user->profile()->save($profile);
				//remove session key
				Session::forget('type');
			}

			Auth::login($user);
			Flash::message('Welcome to Talent4Startups');
			$profile = $user->profile;
			if (is_object($profile) && sizeof($profile) > 0) {
				$tags = $user->profile->tags;
				if (!empty($profile->first_name) && !empty($profile->last_name) && (is_object($tags) && sizeof($tags) > 0)) {
					//redirect to home page if profile has First Name, Last Name and Skills
					return Redirect::intended('');
				}
			}
			// if profile is missing, redirect to edit profile page
			return Redirect::intended('profile');
		}// if not ask for permission first
		else {
			$type = Input::get('type');
			if (is_null($type)) {
				return View::make('registration.select_type');
			}
			Session::put('type', $type);
			// get linkedinService authorization
			$url = $linkedinService->getAuthorizationUri(array('state' => 'DCEEFWF45453sdffef424'));
			// return to linkedin login url
			return Redirect::to((string)$url);
		}
	}
}
