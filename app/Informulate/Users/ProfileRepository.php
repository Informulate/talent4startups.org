<?php namespace Informulate\Users;

class ProfileRepository {

	public function save(Profile $profile)
	{
		return $profile->save();
	}
}
