<?php namespace Informulate\Projects;

class CreateNewProjectCommand {

	/**
	 * @var string username
	 */
	public $name;

	/**
	 * @var string email
	 */
	public $description;

	/**
	 * @param $name
	 * @param $description
	 */
	function __construct($name, $description)
	{
		$this->name = $name;
		$this->description = $description;
	}

}
