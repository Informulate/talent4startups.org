<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfile;
use App\Http\Requests\Request;
use App\Models\Skill;
use App\Models\Startup;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\ThreadRepository;
use App\Commands\UpdateProfile as UpdateProfileCommand;
use Auth, Flash, Image, Redirect, Exception;

class ProfileController extends Controller
{

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('profile.complete');
	}

	/**
	 * Show the users public profile
	 *
	 * @param $id
	 * @return $this
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return view('profile.show')->with('user', $user);
	}

	/**
	 * @return $this
	 */
	public function image(Request $request)
	{
		$user = Auth::User();

		if ($request->isMethod('POST')) {
			$src = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $user->profile->image;

			$image = Image::make($src);
			$image->crop($request->get('w'), $request->get('h'), $request->get('x'), $request->get('y'));
			$image->save($src);

			return Redirect::route('profile_path', ['id' => $user->id]);
		}

		return view('profile.image')->with('user', $user);
	}

	/**
	 * Show the form for creating a user profile.
	 *
	 * @return $this
	 */
	public function edit()
	{
		$user = Auth::user();
		$describes = Skill::orderBy('name')->lists('name', 'id');
		$skills = Tag::orderBy('name')->lists('name', 'id');
		return view('profile.edit')->with('user', $user)->with('describes', $describes)->with('skills', $skills);
	}

	/**
	 * Save the user.
	 * @param CreateProfile $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CreateProfile $request)
	{
		$this->dispatch(
			new UpdateProfileCommand(Auth::user(), $request->all())
		);

		if (array_key_exists('image', $request->all()) and $request->get('image')) {
			return Redirect::route('profile_image_path');
		}

		Flash::message('Your profile has been updated successfully!');

		if ($request->get('type') == 'startup') {

			// redirect to create project if no project added by startup yet.
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
		return view('profile.reset_password');
	}

	/**
	 * Reset requested password for user
	 */
	public function resetPassword()
	{
		$this->resetForm->validate(Input::all());

		extract(Input::only('old_password', 'new_password', 'password_confirmation'));

		if ($new_password != $password_confirmation) {
			return Redirect::route('reset_password')->with('error', 'Confirm password not match');
		}

		//check if user entered old password correct
		$user = User::find(Auth::id());
		if (Hash::check($old_password, $user->password)) {
			try {
				$user->password = $new_password;
				$user->save();

				Flash::message('Your password has been reset successfully!');
				return Redirect::route('reset_password');
			} catch (Exception $e) {
				// fail to update user, generate error and load view

				Flash::message('Error in reset password. Try again later!');
				return Redirect::route('reset_password')->with('error', 'Error in reset password. Try again later!');
			}
		} else {
			return Redirect::route('reset_password')->with('error', 'Old password is incorrect!');
		}
	}
}
