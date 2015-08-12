<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Startup;
use App\Commands\RequestMembership;
use App\Commands\UpdateMembership;
use App\Commands\CancelMembership;
use Flash, Auth, Redirect, Response;

class MembershipController extends Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('profile.complete');
		$this->middleware('blocked.by.announcement');
	}

	/**
	 * Creates a new membership request for the current logged on user
	 * Get /startups/{id}/membership
	 *
	 * @param $startup
	 * @return Response
	 */
	public function request($startup)
	{
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		$this->dispatch(new RequestMembership(Auth::user(), $startup));

		Flash::message('Your request has been sent to the owner!');

		return Redirect::route('startups.show', ['url' => $startup->url]);
	}

	/**
	 * Approves startup membership for the specified user
	 * Get /startups/{startupUrl}/membership/{userId}/approve
	 *
	 * @param $startup
	 * @param $user
	 * @param $action
	 * @return Response
	 */
	public function update($startup, $user, $action)
	{
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		if ($this->currentUserIsOwner($startup->owner)) {
			$user = User::findOrFail($user);
			$this->dispatch(new UpdateMembership($user, $startup, $action));
		}

		return Redirect::route('startups.show', ['url' => $startup->url]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /membership/{id}
	 *
	 * @param  int  $startup
	 * @return Response
	 */
	public function destroy($startup)
	{
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		$this->dispatch(new CancelMembership(Auth::user(), $startup));

		return Redirect::route('startups.show', ['url' => $startup->url]);
	}

}
