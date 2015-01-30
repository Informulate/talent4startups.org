<?php namespace Informulate\Users;

use Illuminate\Support\Facades\Auth;

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
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function findActiveTalents($tag = null, $skill = null, $location = null)
	{
		$results = User::whereHas('profile', function ($q) use ($tag, $skill, $location) {
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
		});

		$paginatedResults = $results->paginate(12);

		if ($skill or $tag) {
			$paginatedResults->appends(['needs' => $skill, 'tag' => $tag]);
		}

		return $paginatedResults;
	}

    /**
     * Search username, first, and last name fields by term
     *
     * @param string $term
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
            $startups = Auth::user()->startups->lists('id');
            $contributions = Auth::user()->contributions->lists('id');
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
