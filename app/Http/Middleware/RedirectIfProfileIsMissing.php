<?php namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Flash, Redirect, Closure, Route;
use Illuminate\Contracts\Routing\Middleware;

class RedirectIfProfileIsMissing implements Middleware {

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
		if ($this->auth->check() and $this->auth->user()->profileIsIncomplete() and Route::currentRouteName() !== 'edit_profile')
		{
			Flash::error('You need to complete your profile before you can continue!');

			return Redirect::route('edit_profile');
		}

		return $next($request);
	}

}
