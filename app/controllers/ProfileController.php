<?php

use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\ProfileForm;
use Informulate\Registration\RegisterUserCommand;
use Informulate\Core\CommandBus;

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
	public function store($userId)
	{
		$this->profileForm->validate(Input::all());

		return Redirect::home();
	}
}
