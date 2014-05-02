<?php

use Zizaco\Confide\ConfideUser;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Collection;

class User extends ConfideUser implements UserInterface, RemindableInterface {

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
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * @param string $value
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function occupations()
	{
		return $this->belongsToMany('Occupation')->withPivot('interest');
	}

	/**
	 * Find a user by its primary key or by its username.
	 *
	 * @param  mixed  $id
	 * @param  array  $columns
	 * @return \Illuminate\Database\Eloquent\Model|Collection|static
	 */
	public static function findByIdOrUsername($id, $columns = array('*'))
	{
		if (is_array($id) && empty($id)) return new Collection;

		$instance = new static;

		return $instance->newQuery()->where('id', '=', $id)->orWhere('username', '=', $id)->first($columns);
	}

}
