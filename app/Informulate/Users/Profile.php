<?php namespace Informulate\Users;


use Laracasts\Commander\Events\EventGenerator;
use Eloquent;

class Profile extends Eloquent {

	use EventGenerator;

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'active','user_type', 'agerange','location','workexperience','about','describe','another_skill','facebook','linkedins','twitter','meetup','image','active'];

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
		$profile->location = $profileInfo['location'];
		$profile->agerange = $profileInfo['agerange'];
		$profile->describe = $profileInfo['describe'];
		$profile->workexperience = $profileInfo['workexperience'];
		$profile->about = $profileInfo['about'];
		$profile->facebook = $profileInfo['facebook'];
		$profile->linkedins = $profileInfo['linkedins'];
		$profile->twitter = $profileInfo['twitter'];
		$profile->meetup = $profileInfo['meetup'];
		$profile->active = array_key_exists('active', $profileInfo) ?: false;

		//upload profile picture, if your has selected
		$fileName = '';

		if (isset($profileInfo['image'])) {
			$targetPath = storage_path() . '/images/';
			$fileName = str_random(10) . '.' . $profileInfo['image']->getClientOriginalName();
			$profileInfo['image']->move($targetPath, $fileName);
		}

		$profile->image = $fileName;

		// if we don't have a user type, assume is a talent that failed to create their profile.
		if (is_null($profile->user_type)) {
			$profile->user_type = 'talent';
		}

		$profile->user_id = $user->id;

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
