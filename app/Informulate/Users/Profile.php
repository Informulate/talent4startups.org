<?php namespace Informulate\Users;

use Informulate\Users\Events\ProfileUpdated;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent;

class Profile extends Eloquent {

	use EventGenerator;

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'active'];

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
	public static function updateProfile(User $user, $first_name, $last_name)
	{
		$profile = new static(compact('first_name', 'last_name'));
		$profile->user_id = $user->id;

		$user->raise(new ProfileUpdated($user));

		return $profile;
	}

}
