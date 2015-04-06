<?php namespace App\Http\Controllers\Auth;

use App\Commands\AuthenticateUser;
use App\Http\Controllers\Controller;
use App\Listeners\AuthenticateUserListener;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Redirect, Session;

class AuthController extends Controller implements AuthenticateUserListener {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar $registrar
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * @param AuthenticateUser $authenticateUser
	 * @param Request $request
	 * @param Session $session
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function getLinkedin(AuthenticateUser $authenticateUser, Request $request, Session $session)
	{
		$hasCode = $request->has('code');
		$type = Session::get('type');

		return $authenticateUser->execute($hasCode, $this, $type);
	}

	/**
	 * Store the selected user type on the session
	 *
	 * Since we need to know the user type, and users might register with a social network, store the selected user type on the session
	 * This is most likely called via an ajax get request
	 *
	 * @param Request $request
	 * @return null
	 */
	public function getType(Request $request)
	{
		Session::put('type', $request->get('type'));
	}

	/**
	 * @param User $user
	 * @return mixed
	 */
	public function userHasLoggedIn($user)
	{
		return $user->profileIsIncomplete() ? Redirect::route('edit_profile') : Redirect::to('/');
	}

}
