<?php

namespace App\Http\Controllers;

use App\Models\Community;

class CommunityController extends Controller
{
	public function join($url)
	{
		$community = Community::where('url', '=', $url)->firstOrFail();

		return view('communities.join')->with(compact('community'));
	}

	public function login($url)
	{
		$community = Community::where('url', '=', $url)->firstOrFail();

		return view('communities.login')->with(compact('community'));
	}
}
