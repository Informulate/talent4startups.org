<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Core\CommandBus;
use Informulate\Forms\SignInForm;
use Informulate\Registration\Commands\RegisterUserCommand;
use Informulate\Users\Commands\UpdateProfileCommand;
use Informulate\Users\User;

class SessionsController extends BaseController
{

	use CommandBus;

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
	 * Login the user
	 */
	public function store()
	{
		$formData = Input::only('email', 'password');
		$this->signInForm->validate($formData);

		if (Auth::attempt($formData)) {
			Flash::message('Welcome back to Talent4Startups!');

			// If the user is missing it's profile, force them to update their details
			$user = Auth::user();

			if (is_null($user->profile) or empty($user->profile->first_name) or empty($user->profile->about) or $user->profile->skill_id === 0) {
				return Redirect::to('profile');
			} elseif ($user->type === 'talent' && count($user->startups) > 0 ) {
				return Redirect::route('startups.show', ['url' => $user->startups[0]->url]);
			} elseif ($user->type === 'startup' && count($user->startups) == 0) {
				return Redirect::route('startups.create');
			} elseif ($user->type === 'talent') {
				if (!empty($user->profile->skill_id)) {
					return Redirect::route('startups.index', ['needs' => $user->profile->skill_id]);
				}
			} else {
				if (!empty($user->startups[0]->needs[0]->skill_id)) {
					return Redirect::route('talents.index', ['describes' => $user->startups[0]->needs[0]->skill_id]);
				}
			}

			return Redirect::intended('/');
		}

		return Redirect::to('login')->with('email', $formData['email'])->with('error', 'Wrong email/password entered.');
	}

	/**
	 * Login with linked in
	 *
	 * @return Response
	 */
	public function loginWithLinkedIn()
	{
		// get data from input
		$code = Input::get('code');
		$linkedInService = OAuth::consumer('Linkedin');

		if (!empty($code)) {
			$token = $linkedInService->requestAccessToken($code);
			$result = json_decode($linkedInService->request('/people/~?format=json'), true);
			$email = json_decode($linkedInService->request('/people/~/email-address?format=json'), true);
			$user = User::where('email', '=', $email)->first();

			if (is_null($user) and $token) {
				// We should have the type stored on the session if for whatever reason that fails, default to talents then.
				$user = $this->execute(
					new RegisterUserCommand($email, $email, $code, $type = Session::get('type') ?: 'talent')
				);

				$this->execute(
					new UpdateProfileCommand($user, [
						'first_name' => $result['firstName'],
						'last_name' => $result['lastName'],
						'linked_in' => $result['siteStandardProfileRequest']['url'],
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

				return Redirect::intended('/');
			}
		}

		$type = Session::get('type') ?: Input::get('type');

		if (Route::currentRouteName() === 'register_linked_in' and is_null($type)) {
			return View::make('registration.select_type');
		}

		Session::put('type', $type);

		$url = $linkedInService->getAuthorizationUri(['state' => 'DCEEFWF45453sdffef424']); // TODO: What is this?

		return Redirect::to((string)$url);
	}

	/**
	 * Log the user out and redirect to the home page
	 *
	 * @return Redirect
	 */
	public function destroy()
	{
		Auth::logout();
		Flash::message('You have now been logged out');
		return Redirect::home();
	}

	/**
	 * Store the selected user type on the session
	 *
	 * Since we need to know the user type, and users might register with a social network, store the selected user type on the session
	 * This is most likely called via an ajax get request
	 *
	 * @return null
	 */
	public function storeUserType()
	{
		Session::put('type', Input::get('type'));
	}
}
