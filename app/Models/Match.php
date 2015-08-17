<?php

namespace App\Models;

use Informulate\Startups\Events\StartupCreated;
use Laracasts\Commander\Events\EventGenerator;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{

	/**
	 * Fillable fields for a new project
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'startup_id', 'debug', 'description', 'ignored', 'weight', 'need_id'];

    /**
     * Create a new match
     *
     * @param $attributes
     * @return static
     */
    public static function create(array $attributes = [])
    {
        $need = new static($attributes);
        return $need;
    }

	/**
	 * The Match's user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

    /**
     * The Match's startup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function startup()
    {
        return $this->belongsTo('App\Models\Startup', 'startup_id');
    }

    public function needs()
    {
        return $this->belongsToMany('App\Models\Need');
    }
}
