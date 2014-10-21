<?php namespace Informulate\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Informulate\Registration\Events\UserRegistered;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent, Hash;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator;

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'password'];

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
	public function projects()
	{
		return $this->hasMany('Informulate\Projects\Project');
	}

	/**
	 * The projects the user contributes to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function contributions()
	{
		return $this->belongsToMany('Informulate\Projects\Project');
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
	 * @return static
	 */
	public static function register($username, $email, $password)
	{
		$user = new static(compact('username', 'email', 'password'));

		$user->raise(new UserRegistered($user));

		return $user;
	}

}
