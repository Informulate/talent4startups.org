<?php

class ContactMethod extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contact_methods';

	public function users()
	{
		return $this->hasMany('User');
	}

}
