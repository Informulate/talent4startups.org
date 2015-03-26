<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Stage;
use App\Models\Startup;
use App\Models\Tag;
use App\Repositories\StartupRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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

		$this->middleware('auth');
		$this->beforeFilter('@isCurrentOwnerFilter', ['only' => ['edit', 'update']]);
	}

	/**
	 * Index that shows all active startups.
	 *
	 * @return Response
	 */
	public function index()
	{
		$startups = $this->repository->allActive(Input::get('tag'), Input::get('needs'));
		$needs = Skill::lists('name', 'id');

		return view('startups.index')->with('startups', $startups)->with('needs', $needs);
	}

	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tags = Tag::lists('name', 'id');
		$stages = Stage::lists('name', 'id');
		$needs = Skill::lists('name', 'id');

		return view('startups.create')->with('tags', $tags)->with('startupTags', '')->with('stages', $stages)->with('needs', $needs);
	}

	/**
	 * Save the user.
	 */
	public function store()
	{
		$this->startupForm->validate(Input::all());

		$startup = $this->execute(
			new CreateNewStartupCommand(Auth::user(), (object) Input::all())
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
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		if (false === $this->currentUserIsOwner($startup->owner) and $startup->published == false) {
			App::abort(404);
		}

		$requests = $startup->members()->where('status', 'pending')->get();
		$members = $startup->members()->where('status', 'approved')->get();

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
		$tags = Tag::lists('name', 'id');
		$stages = Stage::lists('name', 'id');
		$needs = Skill::lists('name', 'id');

		return view('startups.edit')->with('startup', $startup)->with('tags', $tags)->with('stages', $stages)->with('needs', $needs);
	}


	/*
	 * Update startup in storage
	 *
	 * @param $startup
	 */
	/**
	 * @param $startup
	 * @return mixed
	 * @throws \Laracasts\Validation\FormValidationException
	 */
	public function update($startup)
	{
		$startup = Startup::where('url', '=', $startup)->firstOrFail();
		$this->startupForm->validate(Input::all(), $startup->id);

		$this->execute(
			new UpdateStartupCommand($startup, Input::all())
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

	/**
	 * @param $route
	 * @param $request
	 */
	public function isCurrentOwnerFilter($route, $request)
	{
		$parameters = $route->parameters();
		$startup = $parameters['startups'];
		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		if (false === $this->currentUserIsOwner($startup->owner)) {
			return Redirect::route('startups.show', ['startup' => $startup->url]);
		}
	}
}
