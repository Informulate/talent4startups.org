<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\SignInForm;
use Informulate\Registration\Commands\RegisterUserCommand;
use Informulate\Users\Commands\UpdateProfileCommand;
use Informulate\Users\User;
use Informulate\Users\Profile;
use Informulate\Tags\Tag;

class SessionsController extends BaseController
{

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
			if (is_object($profile) && sizeof($profile) > 0) {
				$tags = Auth::user()->profile->tags;
				if (!empty($profile->first_name) && !empty($profile->last_name) && (is_object($tags) && sizeof($tags) > 0)) {
					//redirect to home page if profile has First Name, Last Name and Skills
					return Redirect::intended('');
				}
			}
			// if profile is missing, redirect to edit profile page
			return Redirect::intended('profile');
		}
		//if wrong email/password entered
		return Redirect::to('login')->with('email', $formData['email'])->with('error', 'Wrong email/password entered.');
	}

	/*
	* Login with linked in
	*/
	public function loginWithLinkedIn()
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

	public function destroy()
	{
		Auth::logout();
		Flash::message('You have now been logged out');
		return Redirect::home();
	}
}
