<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth, Redirect, Route, Flash;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	/**
	 * Before filter to validate the user has completed the profile
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function isProfileCompleteFilter()
	{
		if (Auth::user() and Auth::user()->profileIsIncomplete() and Route::currentRouteName() !== 'edit_profile') {
			Flash::error('You need to complete your profile before you can continue!');

			return Redirect::route('edit_profile');
		}
	}

	/**
	 * @param $owner
	 * @return bool
	 */
	public function currentUserIsOwner($owner)
	{
		return Auth::user() and $owner->id == Auth::user()->id;
	}
}
