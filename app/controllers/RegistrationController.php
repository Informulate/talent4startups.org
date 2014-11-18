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

	/*
	* Register user through Linked-in
	*/

	public function registerWithLinkedIn()
	{
		// get data from input
		$code = Input::get('code');
		$linkedInService = OAuth::consumer('LinkedIn');

		if (!empty($code)) {
			$token = $linkedInService->requestAccessToken($code);
			$result = json_decode($linkedInService->request('/people/~?format=json'), true);
			$email = json_decode($linkedInService->request('/people/~/email-address?format=json'), true);
			$user = User::where('email', '=', $email)->first();

			if (is_null($user) and $token) {
				$user = $this->execute(
					new RegisterUserCommand($email, $email, $code, $type = Session::get('type') ?: 'talent')
				);

				$this->execute(
					new UpdateProfileCommand($user, [
						'first_name' => $result['firstName'],
						'last_name' => $result['lastName'],
						'linkedIn' => $result['siteStandardProfileRequest']['url'],
						'published' => true
					])
				);

				Flash::message('Welcome to Talent4Startups');
			}

			if ($token) {
				Auth::login($user);

				if (is_null($user->profile)) {
					return Redirect::route('edit_profile');
				}

				return Redirect::intended('home');
			}
		}

		$type = Input::get('type');

		if (is_null($type)) {
			return View::make('registration.select_type');
		}

		Session::put('type', $type);

		$url = $linkedInService->getAuthorizationUri(['state' => 'DCEEFWF45453sdffef424']);

		return Redirect::to((string)$url);
	}
}
