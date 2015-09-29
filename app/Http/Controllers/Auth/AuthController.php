<?php namespace App\Http\Controllers\Auth;

use App\Commands\AuthenticateUser;
use App\Http\Controllers\Controller;
use App\Listeners\AuthenticateUserListener;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Redirect, Session, Validator;

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
	 * @var string
	 */
	protected $redirectPath;
	protected $loginPath;

	/**
	 * Create a new authentication controller instance.
	 */
	public function __construct()
	{
		$this->redirectPath = '/';
		$this->loginPath = '/auth/login';

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * @inheritdoc
	 */
	public function getRegister(Request $request)
	{
		return view('auth.register')->with('type', 'talent');
	}

	/**
	 * Handle a registration request for the application.
	 * Overwritten to allow direct registrations to communities.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails()) {
			$this->throwValidationException(
				$request, $validator
			);
		}

		$user = $this->create($request->all());
		Auth::login($user);

		if ($request->has('join')) {
			$url = $request->get('join');
			$this->redirectPath = '/discussions';
			$user->join($url);
		}

		return redirect($this->redirectPath());
	}

	/**
	 * Handle a login request to the application.
	 * Overwritten to allow direct registrations to communities.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			$this->loginUsername() => 'required', 'password' => 'required',
		]);

		if ($request->has('join')) {
			$url = $request->get('join');
			$this->redirectPath = '/discussions';
			$this->loginPath = route('community.login', ['url' => $url]);
		}

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		$throttles = $this->isUsingThrottlesLoginsTrait();

		if ($throttles && $this->hasTooManyLoginAttempts($request)) {
			return $this->sendLockoutResponse($request);
		}

		$credentials = $this->getCredentials($request);

		if (Auth::attempt($credentials, $request->has('remember'))) {
			return $this->handleUserWasAuthenticated($request, $throttles);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		if ($throttles) {
			$this->incrementLoginAttempts($request);
		}

		return redirect($this->loginPath())
			->withInput($request->only($this->loginUsername(), 'remember'))
			->withErrors([
				$this->loginUsername() => $this->getFailedLoginMessage(),
			]);
	}

	/**
	 * @param AuthenticateUser $authenticateUser
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function getLinkedin(AuthenticateUser $authenticateUser, Request $request)
	{
		if ($request->has('join')) {
			// Since we are about to redirect to LinkedIn, we need to store the community url in the session.
			Session::put('join', $request->get('join'));
		}

		$hasCode = $request->has('code');

		return $authenticateUser->execute($hasCode, $this);
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
		if (Session::has('join')) {
			Session::remove('join');
			return Redirect::to('/discussions');
		}

		return $user->profileIsIncomplete() ? Redirect::route('setup_profile') : Redirect::to('/');
	}

	public function authenticated($request, $user)
	{
		if (Session::has('join')) {
			$user->join(Session::get('join'));
			$user->save();
			Session::remove('join');
		}

		return redirect()->intended($this->redirectPath());
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'type' => 'required',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'username' => $data['email'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'type' => $data['type'],
		]);
	}

}
