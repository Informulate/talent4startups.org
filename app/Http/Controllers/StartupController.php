<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Skill;
use App\Models\Stage;
use App\Models\Startup;
use App\Http\Requests\CreateStartup;
use App\Http\Requests\UpdateStartup;
use App\Repositories\StartupRepository;
use App\Commands\CreateStartup as CreateStartupCommand;
use App\Commands\UpdateStartup as UpdateStartupCommand;
use App, Auth, Flash, Input, Redirect, Response;
use Route;

class StartupController extends Controller
{

	/**
	 * @var StartupRepository
	 */
	private $repository;

	/**
	 * Constructor
	 *
	 * @param StartupRepository $repository
	 */
	function __construct(StartupRepository $repository)
	{
		$this->repository = $repository;

		$this->middleware('auth', ['except' => ['index', 'show']]);
		$this->middleware('profile.complete');
		$this->middleware('startup.owner', ['only' => ['edit', 'update']]);
	}

	/**
	 * Index that shows all active startups.
	 *
	 * @return Response
	 */
	public function index()
	{
		$startups = $this->repository->allActive(Input::get('tag'), Input::get('needs'));
		$needs = Skill::lists('name', 'id')->all();

		return view('startups.index')->with('startups', $startups)->with('needs', $needs);
	}

	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tags = Tag::lists('name', 'id')->all();
		$stages = Stage::lists('name', 'id')->all();
		$needs = Skill::lists('name', 'id')->all();
		$route = Route::currentRouteName() == 'setup_startup' ? 'setup_startup' : 'startups.store';

		return view('startups.create')->with('tags', $tags)->with('startupTags', '')->with('stages', $stages)->with('needs', $needs)->with('route', $route);
	}

	/**
	 * Save the user.
	 * @param CreateStartup $request
	 * @return Response
	 */
	public function store(CreateStartup $request)
	{
		$startup = $this->dispatch(
			new CreateStartupCommand(Auth::user(), (object) $request->all())
		);

		Flash::message('New Startup Created');

		return Redirect::route('startups.show', ['url' => $startup->url]);
	}

	/**
	 * Display a startup
	 *
	 * @param $startup
	 * @return \Illuminate\View\View
	 */
	public function show($startup)
	{
		$startup = Startup::where('url', '=', $startup)->with('owner')->with('ratings')->with('needs')->with('tags')->firstOrFail();

		if (false === $this->currentUserIsOwner($startup->owner) and $startup->published == false) {
			App::abort(404);
		}

		$requests = $startup->members()->where('status', 'pending')->with('profile')->get();
		$members = $startup->members()->where('status', 'approved')->with('profile')->get();

		return view('startups.show')->with('startup', $startup)->with('requests', $requests)->with('members', $members);
	}

	/*
	 * load view for edit startup with tags
	 * @param string $startup (url)
	 */
	/**
	 * @param $startup
	 * @return $this
	 */
	public function edit($startup)
	{
		$startup = Startup::where('url', '=', $startup)->firstOrFail();
		$tags = Tag::lists('name', 'id')->all();
		$stages = Stage::lists('name', 'id')->all();
		$needs = Skill::lists('name', 'id')->all();

		return view('startups.edit')->with('startup', $startup)->with('tags', $tags)->with('stages', $stages)->with('needs', $needs);
	}


	/**
	 * @param UpdateStartup $request
	 * @param $startup
	 * @return mixed
	 */
	public function update(UpdateStartup $request, $startup)
	{
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		$this->dispatch(
			new UpdateStartupCommand($startup, $request->all())
		);

		Flash::message('Startup updated successfully!');

		return Redirect::action('StartupController@show', $startup->url);
	}


	/**
	 * Destroy a record.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		// TODO: Implement proper startup deactivation (We don't want to delete it we just want to deactivate it)
	}
}
