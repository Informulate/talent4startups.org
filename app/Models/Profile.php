<?php

namespace App\Models;

use App\Events\ProfileCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class Profile extends Model
{

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'location', 'about', 'facebook', 'twitter', 'youtube', 'published', 'image', 'tagline'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

	/**
	 * Update a user's profile
	 *
	 * @param User $user
	 * @param $attributes
	 *
	 * @return static
	 */
	public static function updateProfile(User $user, array $attributes)
	{
		$profile = $user->profile;
		$new = false;

		if (is_null($profile)) {
			$profile = new static();
			$new = true;
		}

		$profile->first_name = $attributes['first_name'];
		$profile->last_name = $attributes['last_name'];
		$profile->tagline = array_key_exists('tagline', $attributes) ? $attributes['tagline'] : '';
		$profile->location = array_key_exists('location', $attributes) ? $attributes['location'] : '';
		$profile->skill_id = array_key_exists('describe', $attributes) ? $attributes['describe'] : '';
		$profile->profession_id = array_key_exists('profession', $attributes) ? $attributes['profession'] : '';
		$profile->about = array_key_exists('about', $attributes) ? $attributes['about'] : '';
		$profile->facebook = array_key_exists('facebook', $attributes) ? $attributes['facebook'] : '';
		$profile->twitter = array_key_exists('twitter', $attributes) ? $attributes['twitter'] : '';
		$profile->youtube = array_key_exists('youtube', $attributes) ? $attributes['youtube'] : '';
		$profile->published = array_key_exists('published', $attributes) ? true : false;
		$profile->user_id = $user->id;

		// To prevent incomplete profiles from been shown, check if the main skill is missing.
		if (is_null($profile->skill()) or $profile->skill_id == 0) {
			$profile->published = false;
		}

		if ($new) {
			$profile->save();
			$user->profile = $profile;
			Event::fire(new ProfileCreated($profile, $user));
		}

		return $profile;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function skill()
	{
		return $this->belongsTo('App\Models\Skill');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function profession()
	{
		return $this->belongsTo('App\Models\Profession');
	}

	public function hasHiddenTags()
	{
		return count($this->previewTags()) < count($this->tags);
	}

	public function previewTags()
	{
		$charCount = 0;
		$results = [];

		foreach ($this->tags as $tag) {
			$charCount += strlen($tag->name);

			if (count($results) == 0 or $charCount < 20) {
				$results[] = $tag;
			} else {
				return $results;
			}
		}

		return $results;
	}

	/**
	 * The owner of this profile
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Models\Tag');
	}

}
