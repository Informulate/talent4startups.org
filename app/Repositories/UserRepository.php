<?php

namespace App\Repositories;

use App\Models\User;
use Auth, Hash;

class UserRepository
{
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
     * @param $userData
     * @param $type
     * @return User
     */
	public function findOrCreate($userData, $type)
	{
		$user = User::where('email', '=', $userData->email)->first();

		if (!$user) {
			// If the user tried to login with out an account, default to talent when creating the user.
			if (is_null($type)) {
				$type = 'talent';
			}

			$user = User::register($userData->email, $userData->email, Hash::make($userData->email) , $type);
		}

		return $user;
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
	 * @param null $tag
	 * @param null $skill
	 * @param null $location
	 * @param null $orderBy
	 * @param int $perPage
	 * @param null $profession
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function findActiveTalents($tag = null, $skill = null, $location = null, $orderBy = null, $perPage = 12, $profession = null)
	{
		$results = User::whereHas('profile', function ($q) use ($tag, $skill, $location, $orderBy, $profession) {
			$q->where('published', '=', true);

			if ($location) {
				$q->where('location', '=', $location);
			}

			if ($tag) {
				$q->whereHas('tags', function ($q2) use ($tag) {
					$q2->where('tags.name', '=', $tag);
				});
			}

			if ($skill) {
				$q->whereHas('skill', function ($q) use ($tag, $skill) {
					$q->where('id', '=', $skill);
				});
			}
			if ($profession) {
				$q->where('profession_id', '=', $profession);
			}
		})->with('ratings')->with('profile');

		if ($orderBy) {
			$results->orderBy($orderBy);
		} else {
			$results->orderBy('id', 'DESC');
		}

		$paginatedResults = $results->paginate($perPage);

		if ($skill or $tag) {
			$paginatedResults->appends(['describes' => $skill, 'tag' => $tag]);
		}

		return $paginatedResults;
	}

	/**
	 * Search username, first, and last name fields by term
	 *
	 * @param string $term
	 * @param bool $isAdmin
	 * @return mixed
	 */
	public static function search($term, $isAdmin = false)
	{
		$results = User::where(function ($query) use ($term) {
				$query->where('users.username', 'LIKE', $term . '%')
					->orWhere('profiles.first_name', 'LIKE', $term . '%')
					->orWhere('profiles.last_name', 'LIKE', $term . '%');
			})
			->join('profiles', 'users.id', '=', 'profiles.user_id')
			->select('users.id', 'first_name', 'last_name')
			->groupBy('users.id');

		if (!$isAdmin) {
			$startups = Auth::user()->startups->lists('id')->all();
			$contributions = Auth::user()->contributions->lists('id')->all();

			$startups = array_merge($startups, $contributions);

			$results->join('startup_user', 'startup_user.user_id', '=', 'users.id')
				->whereIn('startup_user.startup_id', $startups);
		}

		$paginatedResults = $results->paginate(15);

		return $paginatedResults;
	}

	/**
	 * Is the current user allowed to message another user
	 *
	 * @param $userId recipient
	 * @return bool
	 */
	public static function canMessage($userId)
	{
		$startups = Auth::user()->startups->lists('id');
		$contributions = Auth::user()->contributions->lists('id');
		$startups = array_merge($startups, $contributions);

		$results = User::where('users.id', '=', $userId)
			->join('profiles', 'users.id', '=', 'profiles.user_id')
			->join('startup_user', 'startup_user.user_id', '=', 'users.id')
			->whereIn('startup_user.startup_id', $startups)
			->select('users.id')
			->groupBy('users.id')
			->first();

		if (!empty($results['id'])) {
			return true;
		}

		return false;
	}
}
