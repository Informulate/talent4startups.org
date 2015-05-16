<?php

namespace App\Models;

use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, Messagable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'password', 'type'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * The user's profile
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function profile()
	{
		return $this->hasOne('App\Models\Profile')->with('tags')->with('skill');
	}

	/**
	 * The user's projects
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function startups()
	{
		return $this->hasMany('App\Models\Startup');
	}

	/**
	 * The projects the user contributes to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function contributions()
	{
		return $this->belongsToMany('App\Models\Startup')->withPivot('status');
	}

	/**
	 * Hash the password
	 *
	 * @param $password
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = $password;
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

//		$user->raise(new UserRegistered($user));

		return $user;
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
	 * @return string
	 */
	public function avatar()
	{
		if (isset($this->profile)) {
			if (isset($this->profile->image) and $this->profile->image != '') {
				return asset('images/upload/' . $this->profile->image);
			}
		}

		$email = md5($this->email);
		$default = urlencode('http://talent4startups.org/images/talent_generic.jpg');

		return "http://www.gravatar.com/avatar/{$email}?default={$default}";
	}

	/**
	 * Validates that a user has properly completed all the required items for the profile.
	 *
	 * @return bool
	 */
	public function profileIsIncomplete()
	{
		if (is_null($this->profile)) {
			return true;
		}

		if (trim($this->profile->first_name) == '') {
			return true;
		}

		if (trim($this->profile->last_name) == '') {
			return true;
		}

		if (is_null($this->profile->skill) or $this->profile->skill_id == 0) {
			return true;
		}

		return false;
	}

	/**
	 * @return int
	 */
	public function progressPercentage()
	{
		$total = $this->type == 'talent' ? 9 : 13;

		// Username, Password and Email are the first 3 steps of registration
		// If they don't do anything else that's the total number of items completed.
		if (is_null($this->profile)) {
			return 3;
		}

		$points = 3;

		if (trim($this->profile->first_name) != '') {
			$points++;
		}

		if (trim($this->profile->last_name) != '') {
			$points++;
		}

		if (! is_null($this->profile->skill) and $this->profile->skill_id != 0) {
			$points++;
		}

		if (trim($this->profile->location) != '') {
			$points++;
		}

		if (trim($this->profile->about) != '') {
			$points++;
		}

		if (trim($this->profile->location) != '') {
			$points++;
		}

		if ($this->type == 'startup' and count($this->startups) > 0) {
			$points++;

			$startup = $this->startups[0];

			if (trim($startup->description) != '') {
				$points++;
			}

			if (trim($startup->image) != '') {
				$points++;
			}

			if (trim($startup->video) != '') {
				$points++;
			}
		}

		$percentage = ($points / $total) * 100;
		$percentage = $percentage > 100 ? 100 : $percentage;

		return number_format($percentage);
	}

	public function progressClass()
	{
		return $this->progressPercentage() < 20 ? 'danger' : ($this->progressPercentage() < 80 ? 'warning' : 'success');
	}

	public function isNew()
	{
		$thisWeek = new \DateTime();
		$thisWeek->sub(new \DateInterval('P7D'));

		return $this->created_at > $thisWeek;
	}

}
