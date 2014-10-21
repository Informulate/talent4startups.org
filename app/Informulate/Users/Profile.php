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
	protected $fillable = ['first_name', 'last_name', 'active','user_type',
			        'agerange','location','workexperience','about','describe','another_skill','facebook','linkedins','twitter','meetup','image','active'];

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
	 * @param $first_name
	 * @param $last_name
	 * @return static
	 */
	/*
	public static function updateProfile1(User $user, $first_name, $last_name)
	{
		$profile = new static(compact('first_name', 'last_name'));
		$profile->user_id = $user->id;
		$user->raise(new ProfileUpdated($user));
		return $profile;
	} */


	/**
	 * Update a user's profile
	 *
	 * @param User $user
	 * @param array $data
	 * @return static
	 */

	public static function updateProfile(User $user, $profileInfo){
		$profile = Profile::where('user_id','=',$user->id)->first();
		$profile->first_name 	= $profileInfo['first_name'];
		$profile->last_name 	= $profileInfo['last_name'];
		$profile->last_name  	= $profileInfo['last_name'];
		$profile->location   	= $profileInfo['location'];
		$profile->agerange  	= $profileInfo['agerange'];
		$profile->describe  	= $profileInfo['describe'];
		$profile->workexperience= $profileInfo['workexperience'];
		$profile->about  	= $profileInfo['about'];
		$profile->facebook  	= $profileInfo['facebook'];
		$profile->linkedins  	= $profileInfo['linkedins'];
		$profile->twitter  	= $profileInfo['twitter'];
		$profile->meetup  	= $profileInfo['meetup'];
		return $profile;			
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function skills()
	{
		return $this->belongsToMany('Informulate\Skills\Skill');
	}

}
