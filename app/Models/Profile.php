<?php

namespace App\Models;

use Informulate\Users\Events\ProfileCreated;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'location', 'about', 'facebook', 'twitter', 'youtube', 'published', 'image'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

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
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function skill()
	{
		return $this->belongsTo('App\Models\Skill');
	}

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
		$profile->location = array_key_exists('location', $attributes) ? $attributes['location'] : '';
		$profile->skill_id = array_key_exists('describe', $attributes) ? $attributes['describe'] : '';
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

//		if ($new) {
//			$profile->raise(new ProfileCreated($profile));
//		}

		return $profile;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Models\Tag');
	}


	/**
	 * @return string
	 */
	public function avatar()
	{
		if (isset($this->image) and $this->image != '') {
			return asset('images/upload/'.$this->image);;
		}

		$email = md5($this->user->email);

		return "http://www.gravatar.com/avatar/{$email}";
	}
}
