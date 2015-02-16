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

        // TODO: This controller method is doing way to much we need to abstract this and separate it into more manageable sections --jesusOmar
		if (Auth::attempt($formData)) {
			Flash::message('Welcome back to Talent4Startups!');

			// If the user is missing it's profile, force them to update their details
			$user = Auth::user();

			if (is_null($user->profile) or empty($user->profile->first_name) or empty($user->profile->last_name) or empty($user->profile->about) or $user->profile->skill_id < 1) {
				$requiredMessage = '<h3>Your profile is incomplete</h3>';
				if (empty($user->profile->first_name)) $requiredMessage .= 'Please provide your first name.<br>';
				if (empty($user->profile->last_name)) $requiredMessage .= 'Please provide your last name.<br>';
				if (empty($user->profile->about)) $requiredMessage .= 'Please describe yourself a little to get your future team interested.<br>';
				if ($user->profile && $user->profile->skill_id < 1) $requiredMessage .= 'Please pick a role that best describes you.<br>';
				Flash::message($requiredMessage);
				return Redirect::to('profile');
			} elseif ($user->type === 'talent' && count($user->startups) > 0 ) {
				return Redirect::route('startups.show', ['url' => $user->startups[0]->url]);
			} elseif ($user->type === 'startup' && count($user->startups) == 0) {
				return Redirect::route('startups.create');
			} elseif ($user->type === 'startup' && count($user->startups) > 0) {
				$requiredMessage = '<h3>Your startup details are incomplete</h3>';
				foreach ($user->startups as $index => $startup) {
					if(empty($startup->name) or empty($startup->description) or $startup->stage_id < 1 or count($user->startups[$index]->needs) < 1) {
						if(empty($startup->name)) {
							$requiredMessage .= 'Give your startup project a clear name to get team members interested.<br>';
						}
						if(empty($startup->description)) {
							$requiredMessage .= 'Please describe your idea simply and clearly.<br>';
						}
						if ($startup->stage_id < 1) {
							$requiredMessage .= 'Please let people know how far you have taken this idea so far.<br>';
						}
						if (count($user->startups[$index]->needs) < 1) {
							$requiredMessage .= 'You must have specify your need for at least one role in order to publish your startup. You can use tags to further describe your idea.<br>';
						}
						Flash::message($requiredMessage);
						return Redirect::route('startups.edit', ['url' => $startup->url]);
					}
				}
				if (!empty($user->startups[0]->needs[0]->skill_id)) {
					return Redirect::route('talents.index', ['describes' => $user->startups[0]->needs[0]->skill_id]);
				}
			} elseif ($user->type === 'talent') {
				if (!empty($user->profile->skill_id)) {
					return Redirect::route('startups.index', ['needs' => $user->profile->skill_id]);
				}
			} else {
				if (!empty($user->startups[0]->needs[0]->skill_id)) {
					return Redirect::route('talents.index', ['describes' => $user->startups[0]->needs[0]->skill_id]);
				}
			}

			return Redirect::route('profile_path', ['username' => $user->id]);
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
		$type = Session::pull('type') ?: Input::get('type');

		if (!empty($code)) {
			$token = $linkedInService->requestAccessToken($code);
			$result = json_decode($linkedInService->request('/people/~?format=json'), true);
			$email = json_decode($linkedInService->request('/people/~/email-address?format=json'), true);
			$user = User::where('email', '=', $email)->first();

			if (is_null($user) and $token) {
				if (is_null($type)) {
					Session::put('email', $email);
					Session::put('code', $code);
					Session::put('first_name', $result['firstName']);
					Session::put('last_name', $result['lastName']);
					Session::put('linked_in', $result['siteStandardProfileRequest']['url']);

					return View::make('sessions.select_type');
				}

				// We should have the type stored on the session if for whatever reason that fails, default to talents then.
				$user = $this->execute(
					new RegisterUserCommand($email, $email, $code, $type = Session::get('type') ?: 'talent')
				);

				$this->execute(
					new UpdateProfileCommand($user, [
						'first_name' => $result['firstName'],
						'last_name' => $result['lastName'],
						'linked_in' => $result['siteStandardProfileRequest']['url'],
						'published' => false
					])
				);

				Flash::message('Welcome to Talent4Startups');
			}

			if ($token) {
				Auth::login($user);

                // TODO: This clusterfudge needs to be refactor also --jesusOmar
				if (is_null($user->profile) or empty($user->profile->first_name) or empty($user->profile->last_name) or empty($user->profile->about) or $user->profile->skill_id < 1) {
					$requiredMessage = '<h3>Your profile is incomplete</h3>';
					if (empty($user->profile->first_name)) $requiredMessage .= 'Please provide your first name.<br>';
					if (empty($user->profile->last_name)) $requiredMessage .= 'Please provide your last name.<br>';
					if (empty($user->profile->about)) $requiredMessage .= 'Please describe yourself a little to get your future team interested.<br>';
					if ($user->profile && $user->profile->skill_id < 1) $requiredMessage .= 'Please pick a role that best describes you.<br>';
					Flash::message($requiredMessage);
					return Redirect::to('profile');
				} elseif ($user->type === 'talent' && count($user->startups) > 0 ) {
					return Redirect::route('startups.show', ['url' => $user->startups[0]->url]);
				} elseif ($user->type === 'startup' && count($user->startups) == 0) {
					return Redirect::route('startups.create');
				} elseif ($user->type === 'startup' && count($user->startups) > 0) {
					$requiredMessage = '<h3>Your startup details are incomplete</h3>';
					foreach ($user->startups as $index => $startup) {
						if(empty($startup->name) or empty($startup->description) or $startup->stage_id < 1 or count($user->startups[$index]->needs) < 1) {
							if(empty($startup->name)) {
								$requiredMessage .= 'Give your startup project a clear name to get team members interested.<br>';
							}
							if(empty($startup->description)) {
								$requiredMessage .= 'Please describe your idea simply and clearly.<br>';
							}
							if ($startup->stage_id < 1) {
								$requiredMessage .= 'Please let people know how far you have taken this idea so far.<br>';
							}
							if (count($user->startups[$index]->needs) < 1) {
								$requiredMessage .= 'You must have specify your need for at least one role in order to publish your startup. You can use tags to further describe your idea.<br>';
							}
							Flash::message($requiredMessage);
							return Redirect::route('startups.edit', ['url' => $startup->url]);
						}
					}
				} elseif ($user->type === 'talent') {
					if (!empty($user->profile->skill_id)) {
						return Redirect::route('startups.index', ['needs' => $user->profile->skill_id]);
					}
				} else {
					if (!empty($user->startups[0]->needs[0]->skill_id)) {
						return Redirect::route('talents.index', ['describes' => $user->startups[0]->needs[0]->skill_id]);
					}
				}

				return Redirect::route('profile_path', ['username' => $user->id]);
			}
		}

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
