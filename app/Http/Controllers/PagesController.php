<?php

namespace App\Http\Controllers;

use Response;

class PagesController extends Controller
{
	public function missing()
	{
		return Response::view('errors.missing', [], 404);
	}

	/**
	 * The about us page
	 * Get /about
	 *
	 * @return Response
	 */
	public function about()
	{
		return view('static.about');
	}

	/**
	 * The contact us page
	 * Get /contact
	 *
	 * @return Response
	 */
	public function contact()
	{
		return view('static.contact');
	}

	/**
	 * The FAQ page
	 * Get /faq
	 *
	 * @return Response
	 */
	public function faq()
	{
		return view('static.faq');
	}

	/**
	 * The sponsors
	 * Get /knowledge-base
	 *
	 * @return Response
	 */
	public function knowledgebase()
	{
		return view('static.knowledgebase');
	}

	/**
	 * The privacy page
	 * Get /privacy
	 *
	 * @return Response
	 */
	public function privacy()
	{
		return view('static.privacy');
	}

	/**
	 * The terms of service page
	 * Get /termsofservice
	 *
	 * @return Response
	 */
	public function termsOfService()
	{
		return view('static.termsOfService');
	}
}
