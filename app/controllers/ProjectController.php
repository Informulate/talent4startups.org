<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\ProjectForm;
use Informulate\Projects\CreateNewProjectCommand;
use Informulate\Core\CommandBus;

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
	 * Index that shows all projects.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::paginate( 25 );

		return View::make('project.index')
			->with( 'projects', $projects );
	}

	/**
	 * Show the detail page for project.
	 *
	 * @return Response
	 */
	public function show( $projectid )
	{
		$project = Project::find( $projectid );

		return View::make('project.show')
			->with( 'project', $project );
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

		return Redirect::to('profile');
	}

	/**
 * Destroy a record.
 *
 * @return Response
 */
	public function destroy( $id )
	{
    if( Request::ajax() )
    {   	
	    Project::destroy( $id );
      return 1;
    }
	}
}
