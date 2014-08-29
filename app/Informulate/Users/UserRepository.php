<?php namespace Informulate\Users;

class UserRepository {

	public function save(User $user)
	{
		return $user->save();
	}
}
