<?php namespace App\Http\Middleware;

use App\Models\Startup;
use Illuminate\Contracts\Auth\Guard;
use Auth, Redirect, Closure;

class RedirectIfIsNotStartupOwner {

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
		$startup = $request->segment(2);
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		if (false == Auth::user() or $startup->owner->id != Auth::user()->id) {
			return Redirect::route('startups.show', ['startup' => $startup->url]);
		}

		return $next($request);
	}

}
