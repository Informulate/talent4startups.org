<?php namespace Informulate\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Informulate\Registration\Events\UserRegistered;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent, Hash;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait, EventGenerator, Messagable;

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'password', 'type'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * The user's profile
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function profile()
	{
		return $this->hasOne('Informulate\Users\Profile');
	}

	/**
	 * The user's projects
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function startups()
	{
		return $this->hasMany('Informulate\Startups\Startup');
	}

	/**
	 * The projects the user contributes to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function contributions()
	{
		return $this->belongsToMany('Informulate\Startups\Startup');
	}

	/**
	 * Hash the password
	 *
	 * @param $password
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

	/**
	 * Register a new user
	 *
	 * @param $username
	 * @param $email
	 * @param $password
	 * @param $type
	 *
	 * @return static
	 */
	public static function register($username, $email, $password, $type)
	{
		$user = new static(compact('username', 'email', 'password', 'type'));

		$user->raise(new UserRegistered($user));

		return $user;
	}

	public function ratings()
	{
		return $this->morphMany('Informulate\Ratings\Rating', 'rated');
	}

	public function rating()
	{
		$total_ratings = $score = 0;

		foreach ($this->ratings as $rating) {
			$score = $score + $rating->rating;
			$total_ratings++;
		}

		return $total_ratings > 0 ? round(($score / $total_ratings) * 2, 0, PHP_ROUND_HALF_UP) / 2 : 0;
	}
}
