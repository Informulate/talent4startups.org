<?php namespace Informulate\Startups\Commands;

use Informulate\Startups\Startup;

class UpdateStartupCommand {
	/**
	 * @var array projectInfo
	 */
	public $startup;
	/**
	 * @var $data
	 */
	public $data;

	function __construct(Startup $startup, $data)
	{
		$this->startup = $startup;
		$this->data = $data;
	}

}
