<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
	/**
	 * Fillable fields for a new project
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'name', 'description', 'url', 'goal', 'stage_id', 'video', 'published', 'tagline'];

	/**
	 * Create a new project
	 *
	 * @param $attributes
	 * @return static
	 */
	public static function create(array $attributes = [])
	{
		$startup = new static($attributes);

		return $startup;
	}

	/**
	 * @param Startup $startup
	 * @param array $attributes
	 * @return Startup
	 */
	public static function updateStartup(Startup $startup, array $attributes)
	{
		$slugify = Slugify::create();

		$startup->name = $attributes['name'];
		$startup->tagline = $attributes['tagline'];
		$startup->description = $attributes['description'];
		$startup->url = $slugify->slugify($attributes['name']);
		$startup->stage_id = $attributes['stage_id'];
		$startup->video = $attributes['video'];
		$startup->twitter = $attributes['twitter'];
		$startup->linked_in = $attributes['linked_in'];
		$startup->facebook = $attributes['facebook'];
		$startup->website = $attributes['website'];
		$startup->published = array_key_exists('published', $attributes) ? true : false;

		return $startup;
	}

	/**
	 * The project's owner
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function owner()
	{
		return $this->belongsTo('App\Models\User', 'user_id')->with('profile');
	}

	/**
	 * The project members
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function members()
	{
		return $this->belongsToMany('App\Models\User')->with('profile');
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
					->first()
			);
		}

		return false;
	}

	/**
	 * @param User $user
	 * @return bool
	 */
	public function isApprovedMember(User $user)
	{
		return !is_null(
			DB::table('startup_user')
				->where('startup_id', $this->id)
				->where('user_id', $user->id)
				->where('status', 'approved')
				->first()
		);
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
		return $this->belongsToMany('App\Models\Tag');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function needs()
	{
		return $this->hasMany('App\Models\Need')->with('skill');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function ratings()
	{
		return $this->morphMany('App\Models\Rating', 'rated');
	}

	/**
	 * @return float|int
	 */
	public function rating()
	{
		$total_ratings = $score = 0;

		foreach ($this->ratings as $rating) {
			$score = $score + $rating->rating;
			$total_ratings++;
		}

		return $total_ratings > 0 ? round(($score / $total_ratings) * 2, 0, PHP_ROUND_HALF_UP) / 2 : 0;
	}

	/**
	 * @return bool
	 */
	public function isNew()
	{
		$thisWeek = new \DateTime();
		$thisWeek->sub(new \DateInterval('P7D'));

		return $this->created_at > $thisWeek;
	}
}
