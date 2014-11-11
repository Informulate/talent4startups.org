<?php namespace Informulate\Users;

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
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function findActiveTalents($tag = null, $skill = null)
	{
		$results = User::whereHas('profile', function ($q) use ($tag, $skill) {
			$q->where('published', '=', true);

			if ($tag) {
				$q->whereHas('tags', function ($q2) use ($tag) {
					$q2->where('tags.name', '=', $tag);
				});
			}

			if ($skill) {
				$q->where('skill', '=', $skill);
			}
		});

		$paginatedResults = $results->paginate(16);

		if ($skill or $tag) {
			$paginatedResults->appends(['needs' => $skill, 'tag' => $tag]);
		}

		return $paginatedResults;
	}
}
