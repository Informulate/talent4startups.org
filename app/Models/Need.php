<?php

namespace App\Models;

use Informulate\Startups\Events\StartupCreated;
use Laracasts\Commander\Events\EventGenerator;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{

	/**
	 * Fillable fields for a new project
	 *
	 * @var array
	 */
	protected $fillable = ['quantity', 'startup_id', 'skill_id', 'commitment', 'description'];

    /**
     * Create a new project
     *
     * @param $attributes
     * @return static
     */
    public static function create(array $attributes)
    {
        $need = new static($attributes);
        return $need;
    }

	/**
	 * The need's skill
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function skill()
	{
		return $this->belongsTo('App\Models\Skill', 'skill_id');
	}

    /**
     * The need's startup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function startup()
    {
        return $this->belongsTo('App\Models\Startup', 'startup_id');
    }

	/**
	 * The need's tags
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Models\Tag');
	}
}
