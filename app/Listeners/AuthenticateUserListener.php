<?php

namespace App\Listeners;

interface AuthenticateUserListener {

	/**
	 * @param $user
	 * @return mixed
	 */
	public function userHasLoggedIn($user);

}
