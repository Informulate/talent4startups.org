<?php

namespace App\Http\Controllers;

class PasswordController extends Controller
{

	/**
	 * @return \Illuminate\View\View
	 */
	public function remind()
	{
		return view('password.remind');
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function request()
	{
		$credentials = Input::only(
			'email',
			'password'
		);

		$response = Password::remind($credentials, function ($message) {
			$message->subject('Reset your password (Talent4startups).');
		});

		if ($response == 'reminders.user') {
			return Redirect::back()->with('error', 'Please enter valid email !');
		}

		Flash::message('Reset password link has been sent to your email.');
		return view('password.remind');
	}

	/**
	 * @param $token
	 * @return $this
	 */
	public function reset($token)
	{
		return view('password.reset')->with('token', $token);
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update()
	{
		$credentials = Input::only(
			'email',
			'password',
			'password_confirmation',
			'token'
		);

		$response = Password::reset($credentials, function (User $user, $password) {
			$user->password = $password;
			$user->save();
		});

		switch ($response) {
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));
				break;
			case Password::PASSWORD_RESET:
				return Redirect::home();
				break;
		}
	}
}
