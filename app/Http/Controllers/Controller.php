<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	/**
	 * @param $owner
	 * @return bool
	 */
	public function currentUserIsOwner($owner)
	{
		return Auth::user() and $owner->id == Auth::user()->id;
	}
}
