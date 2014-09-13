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
	protected $fillable = ['user_id', 'name', 'description', 'url'];

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

	/**
	 * The project's owner
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function owner()
	{
		return $this->belongsTo('Informulate\Users\User', 'user_id');
	}

	/**
	 * The project members
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function members()
	{
		return $this->belongsToMany('Informulate\Users\User');
	}

	public function tags()
	{
		return $this->belongsToMany('Informulate\Tags\Tag');
	}
}
