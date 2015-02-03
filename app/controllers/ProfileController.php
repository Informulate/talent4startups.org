<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Informulate\Forms\ProfileForm;
use Informulate\Forms\ResetForm;
use Informulate\Core\CommandBus;
use Informulate\Users\Commands\UpdateProfileCommand;
use Informulate\Users\ThreadRepository;
use Informulate\Users\User;
use Informulate\Startups\Startup;
use Informulate\Tags\Tag;
use Informulate\Users\UserRepository;
use Informulate\Skills\Skill;
use Laracasts\Flash\Flash;

class ProfileController extends BaseController
{

	use CommandBus;

	/**
	 * @var ProfileForm
	 */
	private $profileForm;

	/**
	 * @var ResetForm
	 */
	private $resetForm;
	/**
	 * @var UserRepository
	 */
	private $userRepository;

	/**
	 * Constructor
	 *
	 * @param ProfileForm $profileForm
	 * @param ResetForm $resetForm
	 * @param UserRepository $userRepository
	 */
	function __construct(ProfileForm $profileForm, ResetForm $resetForm, UserRepository $userRepository)
	{
		$this->profileForm = $profileForm;
		$this->resetForm = $resetForm;
		$this->userRepository = $userRepository;
		$this->beforeFilter('auth', ['except' => ['show']]);
	}

	/**
	 * Show the users public profile
	 *
	 * @param $id
	 * @return $this
	 */
	public function show($id)
	{
		$user = User::find($id);

		return View::make('profile.show')->with('user', $user)->with('startups', $user->startups)->with('contributions', $user->contributions);
	}

	/**
	 * Show the form for creating a user profile.
	 *
	 * @return Response
	 */
	public function edit()
	{
		$user = Auth::user();
		$describes = Skill::orderBy('name')->lists('name', 'id');
		$skills = Tag::lists('name', 'id');
		return View::make('profile.edit')->with('user', $user)->with('describes', $describes)->with('skills', $skills);
	}

	/**
	 * Save the user.
	 */
	public function store()
	{
		$this->profileForm->validate(Input::all());

		$this->execute(
			new UpdateProfileCommand(Auth::user(), Input::all())
		);

		Flash::message('Your profile has been updated successfully!');

		if (Input::get('type') == 'startup') {

			// redirect to create projct if no project added by startup yet.
			$projectsCount = Startup::where('user_id', '=', Auth::user()->id)->count();

			if ($projectsCount == 0) {
				return Redirect::route('startups.create');
			}
		}

		return Redirect::intended('/');
	}

	/**
	 * Invite the user to a startup
	 */
	public function invite()
	{
		$userTo = User::findOrFail(Input::get('user_id'));
		$startup = Startup::findOrFail(Input::get('startup_id'));
		$userFrom = Auth::user();
		ThreadRepository::notification('startup.join.invite.talent', $userTo, array('startup' => $startup, 'fromUser' => $userFrom));

		Flash::message('You have successfully invited ' . $userTo->profile->first_name);

		return Redirect::intended('/users/' . $userTo->id);
	}

	/**
	 * Load view for reset password for logged in users
	 */
	public function resetPasswordForm()
	{
		return View::make('profile.reset_password');
	}

	/**
	 * Reset requested password for user
	 */
	public function resetPassword()
	{
		$this->resetForm->validate(Input::all());

		extract(Input::only('old_password', 'new_password', 'password_confirmation'));

		if ($new_password != $password_confirmation) {
			return redirect::route('reset_password')->with('error', 'Confirm password not match');
		}

		//check if user entered old password correct
		$user = User::find(Auth::id());
		if (Hash::check($old_password, $user->password)) {
			try {
				$user->password = $new_password;
				$user->save();

				Flash::message('Your password has been reset successfully!');
				return redirect::route('reset_password');
			} catch (Exception $e) {
				// fail to update user, generate error and load view

				Flash::message('Error in reset password. Try again later!');
				return redirect::route('reset_password')->with('error', 'Error in reset password. Try again later!');
			}
		} else {
			return redirect::route('reset_password')->with('error', 'Old password is incorrect!');
		}
	}
}
