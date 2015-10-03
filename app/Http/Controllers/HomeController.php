<?php

namespace App\Http\Controllers;

use Auth, Redirect, Response, Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('profile.complete');
		$this->middleware('blocked.by.announcement');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::to('/users/' . Auth::id());
	}

	/**
	 * Display the oldest announcement for the user if any.
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function announcement()
	{
		if (Auth::user()->hasPendingAnnouncements()) {
			return view('announcement')->with('announcement', Auth::user()->announcement());
		}

		return Redirect::to('/');
	}

	public function store()
	{
		$announcement = Auth::user()->announcement();

		if ($announcement) {
			$announcement->pivot->accepted = true;
			$announcement->pivot->save();
		}

		return Redirect::to('/');
	}

	public function flag()
	{
		$page = Request::get('page');
		$message = Request::get('message');

		if (Auth::user()) {
			$content = [
				'recipient' => [
					'first_name' => 'Admin',
					'last_name' => 'Admin',
				],
				'body' => Auth::user()->first_name . ' ' . Auth::user()->last_name . ' reported a complaint about this page ' . $page . " with this message: \r\n \r\n \r\n" . $message,
			];
		} else {
			$content = [
				'recipient' => [
					'first_name' => 'Admin',
					'last_name' => 'Admin',
				],
				'body' => 'Someone reported a complaint about this page ' . $page . " with this message: \r\n \r\n \r\n" . $message,
			];
		}

		Mail::send(['html' => 'emails.message'], $content, function ($message) {
			$message
				->from('noreply@talent4startups.org', 'Talent4Startups')
				->to(array('mike.bernat@informulate.net', 'mike@mikebernat.com'))
				->subject("T4S: Report")
			;
		});
	}


}
