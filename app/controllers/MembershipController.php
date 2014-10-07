<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Projects\UpdateProjectMembershipCommand;
use Informulate\Projects\CancelProjectMembershipRequestCommand;
use Informulate\Projects\Project;
use Informulate\Core\CommandBus;
use Informulate\Projects\RequestProjectMembershipCommand;
use Informulate\Users\User;

class MembershipController extends \BaseController {

	use CommandBus;

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->beforeFilter('auth');
	}

	/**
	 * Creates a new membership request for the current logged on user
	 * Get /projects/{id}/membership
	 *
	 * @param $project
	 * @return Response
	 */
	public function request($project)
	{
		/* @var $project \Informulate\Projects\Project */
		$project = Project::where('url', '=', $project)->firstOrFail();

		$this->execute(new RequestProjectMembershipCommand(Auth::user(), $project));

		return Redirect::route('projects.show', ['url' => $project->url]);
	}

	/**
	 * Approves project membership for the specified user
	 * Get /projects/{projectUrl}/membership/{userId}/approve
	 *
	 * @param $project
	 * @param $user
	 * @param $action
	 * @return Response
	 */
	public function update($project, $user, $action)
	{
		$project = Project::where('url', '=', $project)->firstOrFail();

		if ($project->owner == Auth::user()) {
			$user = User::find($user);
			$this->execute(new UpdateProjectMembershipCommand($user, $project, $action));
		}

		return Redirect::route('projects.show', ['url' => $project->url]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /membership/{id}
	 *
	 * @param  int  $project
	 * @return Response
	 */
	public function destroy($project)
	{
		/* @var $project \Informulate\Projects\Project */
		$project = Project::where('url', '=', $project)->firstOrFail();

		$this->execute(new CancelProjectMembershipRequestCommand(Auth::user(), $project));

		return Redirect::route('projects.show', ['url' => $project->url]);
	}

}
