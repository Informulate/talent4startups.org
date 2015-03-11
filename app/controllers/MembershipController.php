<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Startups\UpdateStartupMembershipCommand;
use Informulate\Startups\CancelStartupMembershipRequestCommand;
use Informulate\Startups\Startup;
use Informulate\Core\CommandBus;
use Informulate\Startups\RequestStartupMembershipCommand;
use Informulate\Users\User;

class MembershipController extends \BaseController {

	use CommandBus;

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->beforeFilter('auth');

		parent::__construct();
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
		/* @var $startup \Informulate\Startups\Startup */
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		$this->execute(new RequestStartupMembershipCommand(Auth::user(), $startup));

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

		if ($startup->owner == Auth::user()) {
			$user = User::find($user);
			$this->execute(new UpdateStartupMembershipCommand($user, $startup, $action));
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
		/* @var $startup \Informulate\Startups\Startup */
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		$this->execute(new CancelStartupMembershipRequestCommand(Auth::user(), $startup));

		return Redirect::route('startups.show', ['url' => $startup->url]);
	}

}
