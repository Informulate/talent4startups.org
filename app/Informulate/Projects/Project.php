<?php namespace Informulate\Projects;

use Informulate\Projects\Events\ProjectCreated;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent;

class Project extends Eloquent {

	use EventGenerator;

	/**
	 * Fillable fields for a new project
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'url'];

	/**
	 * Create a new project
	 *
	 * @param $attributes
	 * @return static
	 */
	public static function create(array $attributes)
	{
		$project = new static($attributes);

		$project->raise(new ProjectCreated($project));

		return $project;
	}

	public function tags()
	{
		return $this->belongsToMany('Informulate\Tags\Tag');
	}
}
