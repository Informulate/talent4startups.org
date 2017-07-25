<?php namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Flash, Redirect, Closure, Route;
use Request;

class RedirectIfRequiredAnnouncement {

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
			return Redirect::to('announcement');
		}

		return $next($request);
	}

	/**
	 * @return bool
	 */
	private function needToRedirect()
	{
		$allowedRoutes = ['announcement', 'accept_announcement'];
		$allowedPaths = ['announcement', 'announcement/accept'];

		return $this->auth->check() and $this->auth->user()->hasRequiredAnnouncement() and ! in_array(Route::currentRouteName(), $allowedRoutes) and ! in_array(Request::path(), $allowedPaths);
	}

}
