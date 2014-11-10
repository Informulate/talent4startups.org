<?php namespace Informulate\Startups\Events;

use Informulate\Startups\Startup;

class StartupCreated {

	/**
	 * @var Startup
	 */
	public $startup;

	/**
	 * @param Startup $startup
	 */
	function __construct(Startup $startup)
	{
		$this->startup = $startup;
	}

}
