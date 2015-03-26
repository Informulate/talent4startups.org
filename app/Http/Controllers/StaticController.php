<?php

namespace App\Http\Controllers;

class StaticController extends Controller {

	/**
	 * Constructor
	 */
	function __construct() {}

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
     * The manifesto page
     * Get /manifesto
     *
     * @return Response
     */
    public function manifesto()
    {
        return view('static.manifesto');
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
     * Get /sponsors
     *
     * @return Response
     */
    public function sponsors()
    {
        return view('static.sponsors');
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
