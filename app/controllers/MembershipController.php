<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Projects\CancelProjectMembershipRequestCommand;
use Informulate\Projects\Project;
use Informulate\Core\CommandBus;
use Informulate\Projects\RequestProjectMembershipCommand;

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
	 * Display a listing of the resource.
	 * GET /membership
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /membership/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /membership
	 *
	 * @return Response
	 */
	public function store($project)
	{
		/* @var $project \Informulate\Projects\Project */
		$project = Project::where('url', '=', $project)->firstOrFail();

		$this->execute(new RequestProjectMembershipCommand(Auth::user(), $project));

		return Redirect::route('projects.show', ['url' => $project->url]);
	}

	/**
	 * Display the specified resource.
	 * GET /membership/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /membership/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /membership/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
