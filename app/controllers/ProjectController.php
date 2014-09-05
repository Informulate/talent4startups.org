<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\ProjectForm;
use Informulate\Projects\CreateNewProjectCommand;
use Informulate\Core\CommandBus;
use Informulate\Projects\Project;

class ProjectController extends BaseController {

	use CommandBus;

	/**
	 * @var ProjectForm
	 */
	private $projectForm;

	/**
	 * Constructor
	 *
	 * @param ProjectForm $projectForm
	 */
	function __construct(ProjectForm $projectForm)
	{
		$this->projectForm = $projectForm;

		$this->beforeFilter('auth');
	}


	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('project.create');
	}

	/**
	 * Save the user.
	 */
	public function store()
	{
		$this->projectForm->validate(Input::all());

		extract(Input::only('name', 'description'));

		$project = $this->execute(
			new CreateNewProjectCommand($name, $description)
		);

		Flash::message('New Project Created');

		return Redirect::route('projects.show', ['url' => $project->url]);
	}

	/**
	 * Display a project
	 *
	 * @param $project
	 * @return \Illuminate\View\View
	 */
	public function show($project)
	{
		$project = Project::where('url', '=', $project)->firstOrFail();

		return View::make('project.show')->with('project', $project);;
	}
}
