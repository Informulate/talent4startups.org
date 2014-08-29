<?php namespace Informulate\Projects;

use Eloquent;

class Project extends Eloquent {

	/**
	 * Fillable fields for a new project
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description'];

}
