<?php namespace Informulate\Startups;

use DB;
use Informulate\Users\User;

class StartupRepository
{

	/**
	 * @param Startup $startup
	 * @return bool
	 */
	public function save(Startup $startup)
	{
		return $startup->save();
	}

	public function allActive($tag = null, $needs = null)
	{
		$results = Startup::where('published', '=', true);

		if ($tag) {
			$results->whereHas('tags', function ($q) use ($tag) {
				$q->where('tags.name', '=', $tag);
			});
		}

		if ($needs) {
			$results->whereHas('describes', function ($q) use ($needs) {
				$q->where('skills.name', '=', $needs);
			});
		}

		return $results->paginate(16);
	}

	/**
	 * @param User $user
	 * @param Startup $startup
	 */
	public function addMemberRequest(User $user, Startup $startup)
	{
		DB::insert('insert into startup_user (startup_id, user_id, pending, created_at, updated_at) values (?, ?, ?, NOW() , NOW())', [
			$startup->id,
			$user->id,
			true,
		]);
	}

	/**
	 * @param User $user
	 * @param Startup $startup
	 */
	public function approveMemberRequest(User $user, Startup $startup)
	{
		DB::update('update startup_user set pending = false, approved = true where startup_id = ? and user_id = ?', [
			$startup->id,
			$user->id
		]);
	}

	/**
	 * @param User $user
	 * @param Startup $startup
	 */
	public function rejectMemberRequest(User $user, Startup $startup)
	{
		DB::update('update startup_user set pending = false, rejected = true where startup_id = ? and user_id = ?', [
			$startup->id,
			$user->id
		]);
	}

	/**
	 * @param User $user
	 * @param Startup $startup
	 */
	public function cancelMembershipRequest(User $user, Startup $startup)
	{
		DB::delete('delete from startup_user where startup_id = ? and user_id = ?', [
			$startup->id,
			$user->id
		]);
	}
}
