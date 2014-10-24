<?php namespace Informulate\Users;

class UserRepository {

	/**
	 * Saves the user
	 *
	 * @param User $user
	 * @return bool
	 */
	public function save(User $user)
	{
		return $user->save();
	}

	/**
	 * Finds the user by their username
	 *
	 * @param $username
	 * @return mixed
	 */
	public function findByUsername($username)
	{
		return User::whereUsername($username)->first();
	}

	/**
	 * Returns a paginated list of all active talents
	 *
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function findActiveTalents()
	{
		return User::whereHas('profile', function ($q) {
			$q->where('active', '=', true);
		})->paginate(16);
	}
}
