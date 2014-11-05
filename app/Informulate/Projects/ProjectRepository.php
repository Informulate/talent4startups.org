<?php namespace Informulate\Projects;

use DB;
use Informulate\Users\User;

class ProjectRepository {

	/**
	 * @param Project $project
	 * @return bool
	 */
	public function save(Project $project)
	{
		return $project->save();
	}

	public function allActive($tag = null, $needs = null)
	{
		$results = Project::where('status', '=', '1');

		if ($tag) {
			$results->whereHas('tags', function ($q) use ($tag) {
				$q->where('tags.name', '=', $tag);
			});
		}

		if ($needs) {
			$results->whereHas('describes', function ($q) use ($needs) {
				$q->where('talentdescribes.name', '=', $needs);
			});
		}

		return $results->paginate(16);
	}

	/**
	 * @param User $user
	 * @param Project $project
	 */
	public function addMemberRequest(User $user, Project $project)
	{
		DB::insert('insert into project_user (project_id, user_id, pending, created_at, updated_at) values (?, ?, ?, NOW() , NOW())', [
			$project->id,
			$user->id,
			true,
		]);
	}

	/**
	 * @param User $user
	 * @param Project $project
	 */
	public function approveMemberRequest(User $user, Project $project)
	{
		DB::update('update project_user set pending = false, approved = true where project_id = ? and user_id = ?', [
			$project->id,
			$user->id
		]);
	}

	/**
	 * @param User $user
	 * @param Project $project
	 */
	public function rejectMemberRequest(User $user, Project $project)
	{
		DB::update('update project_user set pending = false, rejected = true where project_id = ? and user_id = ?', [
			$project->id,
			$user->id
		]);
	}

	/**
	 * @param User $user
	 * @param Project $project
	 */
	public function cancelMembershipRequest(User $user, Project $project)
	{
		DB::delete('delete from project_user where project_id = ? and user_id = ?', [
			$project->id,
			$user->id
		]);
	}
}
