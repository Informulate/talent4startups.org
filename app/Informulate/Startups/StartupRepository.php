<?php namespace Informulate\Startups;

use DB;
use Informulate\Users\User;

class StartupRepository
{
	const TAG_CLASS = 'Informulate\\Tags\\Tag';
	const SKILL_CLASS = 'Informulate\\Skills\\Skill';

	/**
	 * @param Startup $startup
	 * @return bool
	 */
	public function save(Startup $startup)
	{
		return $startup->save();
	}

	/**
	 * @param Startup $startup
	 * @param $tags
	 */
	public function updateTags(Startup $startup, $tags)
	{
		$items = explode(',', $tags);
		$this->updateCollection($startup, 'tags', self::TAG_CLASS, $items);
	}

	/**
	 * @param Startup $startup
	 * @param $needs
	 */
	public function updateNeeds(Startup $startup, $needs)
	{
		$items = explode(',', $needs);
		$this->updateCollection($startup, 'needs', self::SKILL_CLASS, $items);
	}

	/**
	 * @param null $tag
	 * @param null $needs
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function allActive($tag = null, $needs = null)
	{
		$results = Startup::where('published', '=', true);

		if ($tag) {
			$results->whereHas('tags', function ($q) use ($tag) {
				$q->where('tags.name', '=', $tag);
			});
		}

		if ($needs) {
			$results->whereHas('needs', function ($q) use ($needs) {
				$q->where('skills.id', '=', $needs);
			});
		}

		$paginatedResults = $results->paginate(16);

		if ($needs or $tag) {
			$paginatedResults->appends(['needs' => $needs, 'tag' => $tag]);
		}

		return $paginatedResults;
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

	/**
	 * @param Startup $startup
	 * @param $property
	 * @param $class
	 * @param array $items
	 */
	private function updateCollection(Startup $startup, $property, $class, array $items)
	{
		$collection = $class::all();

		$itemList = [];
		foreach ($items as $item) {
			$currentObj = $collection->filter(function ($obj) use ($item) {
				return $obj->name == $item;
			})->first();

			if (false == $currentObj) {
				$currentObj = $class::create(['name' => $item]);
				$currentObj->save();
			}

			$itemList[] = $currentObj->id;
		}

		$startup->{$property}()->detach();
		$startup->{$property}()->attach($itemList);
	}
}
