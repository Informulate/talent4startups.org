<?php
/**
 * Created by PhpStorm.
 * User: jesusOmar
 * Date: 5/2/14
 * Time: 2:50 PM
 */

namespace Informulate\Project;

use Ivanlemeshev\Laravel4CyrillicSlug\Facades\Slug;
use Project;
use ProjectController;
use Validator;

/**
 * Class Creator
 * @package Informulate\Project
 */
class Creator
{

	/**
	 * @var ProjectController $listener
	 */
	protected $listener;

	/**
	 * @param ProjectController $listener
	 */
	function __construct(ProjectController $listener)
	{
		$this->listener = $listener;
	}

	/**
	 * @param $input
	 * @return mixed
	 */
	public function create($input)
	{
		$validation = Validator::make($input, Project::getValidations());

		if ($validation->fails()) {
			return $this->listener->projectCreationFails($validation->messages());
		}

		$input['slug'] = Slug::make($input['name']);

		Project::create($input);

		return $this->listener->projectCreationSucceeds();
	}
}
