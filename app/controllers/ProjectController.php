<?php
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\ProjectForm;
use Informulate\Projects\CreateNewProjectCommand;
use Informulate\Core\CommandBus;
use Informulate\Projects\Project;
use Informulate\Projects\ProjectRepository;
use Informulate\Describes\Describe;
use Informulate\Users\User;
use Informulate\Users\Profile;
use Informulate\Tags\Tag;
use Informulate\Stages\Stage;

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
		$this->beforeFilter('auth', ['except' => ['index', 'show','findProjects']]);
	}

	/**
	 * Index that shows all projects.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::paginate(16);
		$describes = Describe::lists('name','id');
		return View::make('project.index')->with('projects', $projects)->with('describes',$describes);
	}

	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tags   = Tag::lists('name','id');
		$stages = Stage::lists('name','id');
		$describes = Describe::lists('name','id');
		return View::make('project.create')->with('tags',$tags)->with('projectTags','')->with('stages',	$stages)->with('describes',$describes);
	}

	/**
	 * Save the user.
	 */
	public function store()
	{
		$this->projectForm->validate(Input::all());
		$project = $this->execute(
			new CreateNewProjectCommand(Auth::user(),(object)Input::all())
		);
		Tag::newProjectTags($project,Input::get('tags')); //assign tags to projects
		Describe::newProjectDescribes($project,Input::get('needs')); //assign describes to projects
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
		$requests = $project->members()->where('pending', true)->get();
		$members = $project->members()->where('approved', true)->get();

		return View::make('project.show')->with('project', $project)->with('requests', $requests)->with('members', $members);
	}

	/**
	 * Return list of projects searched/found
	 *
	 * @return projects\index
	 */
	public function findProjects(){
		if(Request::ajax()) {
		//continue if AJAX request
		$projects = Project::where('status', '=', '1');
		if(!empty(Input::get('tag'))){
		// if user has entered tag
		$tag = !empty(Input::get('tag'))?Tag::where('name', '=', Input::get('tag'))->first():'';
		$tagID = is_object($tag) && sizeof($tag)>0?$tag->id:0;
			$projects->whereHas('tags',function($q) use ($tagID){
			Input::get('tag')!=''?$q->where('tags.id', '=',$tagID):null;
		});
		}

		if(!empty(Input::get('describe'))){
		// if user has entered describe
		$projects->whereHas('describes',function($query){
			Input::get('describe')!=0?$query->where('talentdescribes.id', '=',Input::get('describe')):null;
		});
		}
		$projects = $projects->paginate(16);

		return View::make('project.index-project')->with('projects', $projects)->render();
		}
	}

	public function approveMember($project, $userId)
	{
		if ($project->owner == Auth::user()) {
			$user = User::find($userId);
			if (false == $project->hasMember($user)) {
				//
			}
		}
	}

	 /*
	 * load view for edit project with tags
	 * @param string $project (url)
	 */
	public function edit($project){
		$tags = Tag::lists('name','id');
		$project = Project::where('url', '=', $project)->firstOrFail();
		$stages = Stage::lists('name','id');
		$projectTags = Tag::listProjectTags($project);
		$describes = Describe::lists('name','id');
		return View::make('project.edit')->with('project',$project)->with('projectTags',$projectTags)->with('tags',$tags)->with('stages',$stages)->with('describes',$describes);
	}


	 /*
	 * Update project in storage
	 * @param string url
	 */
	public function update($projectUrl){
		$slugify = Slugify::create();
		$this->projectForm->validate(Input::all());
		$project = Project::where('url', '=', $projectUrl)->firstOrFail();
		$project->url = $slugify->slugify(Input::get('name'));
		$project->name = Input::get('name');
		$project->stage_id = Input::get('stage_id');
		$project->description = Input::get('description');
		$project->goal 	= Input::get('goal');
		$project->video = Input::get('video');
		$project->save();
		$tags = Input::get('tags');
		$describes = Input::get('needs');
		Tag::updateProjectTags($project,$tags);
		Describe::updateProjectDescribes($project,$describes);
		// redirect
		Flash::message('Project updated successfullly!');
		return  Redirect::action('ProjectController@show',$project->url);

	}


	/**
	 * Destroy a record.
	 *
	 * @return Response
	 */
	public function destroy( $id )
	{
		// TODO: Implement proper project deactivation (We don't want to delete it we just want to deactivate it)
	}
}
