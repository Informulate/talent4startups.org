<?php namespace Informulate\Startups;

use Cocur\Slugify\Slugify;
use DB;
use Informulate\Startups\Events\StartupCreated;
use Informulate\Users\User;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent;

class Need extends Eloquent
{
	use EventGenerator;

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
		return $this->belongsTo('Informulate\Skills\Skill', 'skill_id');
	}

    /**
     * The need's startup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function startup()
    {
        return $this->belongsTo('Informulate\Startups\Startup', 'startup_id');
    }

	/**
	 * The need's tags
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('Informulate\Tags\Tag');
	}
}
