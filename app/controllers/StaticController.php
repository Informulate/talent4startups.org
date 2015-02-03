<?php

use Informulate\Core\CommandBus;

class StaticController extends \BaseController {

	use CommandBus;

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
        return View::make('static.about');
	}

    /**
     * The contact us page
     * Get /contact
     *
     * @return Response
     */
    public function contact()
    {
        return View::make('static.contact');
    }

    /**
     * The manifesto page
     * Get /manifesto
     *
     * @return Response
     */
    public function manifesto()
    {
        return View::make('static.manifesto');
    }

    /**
     * The FAQ page
     * Get /faq
     *
     * @return Response
     */
    public function faq()
    {
        return View::make('static.faq');
    }

    /**
     * The sponsors
     * Get /sponsors
     *
     * @return Response
     */
    public function sponsors()
    {
        return View::make('static.sponsors');
    }

    /**
     * The sponsors
     * Get /knowledge-base
     *
     * @return Response
     */
    public function knowledgebase()
    {
        return View::make('static.knowledgebase');
    }

}
