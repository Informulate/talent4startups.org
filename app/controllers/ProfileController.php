<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\ProfileForm;
use Informulate\Core\CommandBus;
use Informulate\Users\UpdateProfileCommand;

class ProfileController extends BaseController {

	use CommandBus;

	/**
	 * @var ProfileForm
	 */
	private $profileForm;

	/**
	 * Constructor
	 *
	 * @param ProfileForm $profileForm
	 */
	function __construct(ProfileForm $profileForm)
	{
		$this->profileForm = $profileForm;
	}


	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function edit()
	{
		return View::make('profile.edit');
	}

	/**
	 * Save the user.
	 */
	public function store()
	{
		$this->profileForm->validate(Input::all());

		extract(Input::only('first_name', 'last_name'));

		$this->execute(
			new UpdateProfileCommand(Auth::user(), $first_name, $last_name)
		);

		return Redirect::route('projects.create');
	}
}
