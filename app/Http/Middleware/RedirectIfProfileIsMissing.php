<?php namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Flash, Redirect, Closure, Route;
use Request;

class RedirectIfProfileIsMissing {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->needToRedirect())
		{
			Flash::error('Please complete your personal profile in order to continue.');

			return Redirect::to('setup/profile');
		}

		return $next($request);
	}

	/**
	 * @return bool
	 */
	private function needToRedirect()
	{
		return $this->auth->check() and $this->auth->user()->profileIsIncomplete() and Route::currentRouteName() !== 'edit_profile' and Request::path() != 'setup/profile';
	}

}
