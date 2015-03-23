<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\StartupForm;
use Informulate\Startups\Commands\CreateNewStartupCommand;
use Informulate\Core\CommandBus;
use Informulate\Startups\Commands\UpdateStartupCommand;
use Informulate\Startups\Startup;
use Informulate\Startups\StartupRepository;
use Informulate\Skills\Skill;
use Informulate\Users\User;
use Informulate\Tags\Tag;
use Informulate\Stages\Stage;

class StartupController extends BaseController
{

	use CommandBus;

	/**
	 * @var StartupForm
	 */
	private $startupForm;
	/**
	 * @var StartupRepository
	 */
	private $repository;

	/**
	 * Constructor
	 *
	 * @param StartupForm $startupForm
	 * @param StartupRepository $repository
	 */
	function __construct(StartupForm $startupForm, StartupRepository $repository)
	{
		$this->startupForm = $startupForm;
		$this->repository = $repository;

		$this->beforeFilter('auth', ['except' => ['index', 'show', 'search']]);
		$this->beforeFilter('@isCurrentOwnerFilter', ['only' => ['edit', 'update']]);

		parent::__construct();
	}

	/**
	 * Index that shows all active startups.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (! Auth::User()) {
			// Temporary lock per request on ticket #111
			return View::make('layouts.partials.login-required')->render();
		}

		$startups = $this->repository->allActive(Input::get('tag'), Input::get('needs'));

		if (Request::ajax()) {
			return View::make('startups.list')->with('startups', $startups)->render();
		}

		$needs = Skill::lists('name', 'id');

		return View::make('startups.index')->with('startups', $startups)->with('needs', $needs);
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

		return View::make('startups.create')->with('tags', $tags)->with('startupTags', '')->with('stages', $stages)->with('needs', $needs);
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
		if (!Auth::User()) {
			// Temporary lock per request on ticket #111
			return View::make('layouts.partials.login-required')->render();
		}

		$startup = Startup::where('url', '=', $startup)->firstOrFail();

		if (Auth::User() != $startup->owner and $startup->published == false) {
			App::abort(404);
		}

		$requests = $startup->members()->where('status', 'pending')->get();
		$members = $startup->members()->where('status', 'approved')->get();

		return View::make('startups.show')->with('startup', $startup)->with('requests', $requests)->with('members', $members);
	}

	/**
	 * @param $startup
	 * @param $userId
	 */
	public function approveMember($startup, $userId)
	{
		if ($startup->owner == Auth::user()) {
			$user = User::find($userId);
			if (false == $startup->hasMember($user)) {
				//
			}
		}
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

		return View::make('startups.edit')->with('startup', $startup)->with('tags', $tags)->with('stages', $stages)->with('needs', $needs);
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

		if ($startup->owner != Auth::user()) {
			return Redirect::route('startups.show', ['startup' => $startup->url]);
		}
	}
}
