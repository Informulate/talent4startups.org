<?php namespace Informulate\Users;

use Laracasts\Commander\Events\EventGenerator;
use Eloquent;

class Profile extends Eloquent
{
	use EventGenerator;

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'location', 'about', 'skill', 'facebook', 'linked_in', 'twitter', 'meetup', 'published'];

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
		return $this->belongsTo('User');
	}

	/**
	 * Update a user's profile
	 *
	 * @param User $user
	 * @param $profileInfo
	 *
	 * @return static
	 */
	public static function updateProfile(User $user, $profileInfo)
	{
		$profile = $user->profile;

		if (is_null($profile)) {
			$profile = new static();
		}

		$profile->first_name = $profileInfo['first_name'];
		$profile->last_name = $profileInfo['last_name'];
		$profile->location = array_key_exists('location', $profileInfo) ? $profileInfo['location'] : '';
		$profile->skill = array_key_exists('describe', $profileInfo) ? $profileInfo['describe'] : '';
		$profile->about = array_key_exists('about', $profileInfo) ? $profileInfo['about'] : '';
		$profile->facebook = array_key_exists('facebook', $profileInfo) ? $profileInfo['facebook'] : '';
		$profile->linked_in = array_key_exists('linked_in', $profileInfo) ? $profileInfo['linked_in'] : '';
		$profile->twitter = array_key_exists('twitter', $profileInfo) ? $profileInfo['twitter'] : '';
		$profile->meetup = array_key_exists('meetup', $profileInfo) ? $profileInfo['meetup'] : '';
		$profile->published = array_key_exists('published', $profileInfo) ? true : false;
		$profile->user_id = $user->id;

		if (array_key_exists('skills', $profileInfo)) {
			// We need to save the profile before we can attach tags to it.
			$profile->save();
			$profile->tags()->detach();// remove all skills of project
			$profile->tags()->attach($profileInfo['skills']);
		}

		return $profile;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('Informulate\Tags\Tag');
	}
}
