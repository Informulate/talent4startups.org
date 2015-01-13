<?php namespace Informulate\Startups;

use Cocur\Slugify\Slugify;
use DB;
use Informulate\Startups\Events\StartupCreated;
use Informulate\Users\User;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent;

class Startup extends Eloquent
{
	use EventGenerator;

	/**
	 * Fillable fields for a new project
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'name', 'description', 'url', 'goal', 'stage_id', 'video'];

	/**
	 * Create a new project
	 *
	 * @param $attributes
	 * @return static
	 */
	public static function create(array $attributes)
	{
		$startup = new static($attributes);

		$startup->raise(new StartupCreated($startup));

		return $startup;
	}

	public static function updateStartup(Startup $startup, array $attributes)
	{
		$slugify = Slugify::create();

		$startup->name = $attributes['name'];
		$startup->description = $attributes['description'];
		$startup->url = $slugify->slugify($attributes['name']);
//		$startup->stage_id = $attributes['stage_id'];
		$startup->video = $attributes['video'];
		$startup->published = true;

		return $startup;
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function members()
	{
		return $this->belongsToMany('Informulate\Users\User');
	}

	/**
	 * @param User $user
	 * @return bool
	 */
	public function hasMember(User $user = null)
	{
		if ($user) {
			return !is_null(
				DB::table('startup_user')
					->where('startup_id', $this->id)
					->where('user_id', $user->id)
					->where('status', 'approved')
					->first()
			);
		}

		return false;
	}

	/**
	 * @param User $user
	 * @return bool
	 */
	public function hasPendingInvitationFrom(User $user = null)
	{
		if ($user) {
			return !is_null(
				DB::table('startup_user')
					->where('startup_id', $this->id)
					->where('user_id', $user->id)
					->where('status', 'pending')
					->first()
			);
		}

		return false;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('Informulate\Tags\Tag');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function needs()
	{
		return $this->belongsToMany('Informulate\Skills\Skill');
	}
}