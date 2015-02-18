<?php namespace Informulate\Startups;

use DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Input;
use Informulate\Startups\Events\UserApplied;
use Informulate\Startups\Events\UserDenied;
use Informulate\Startups\Events\UserJoined;
use Informulate\Startups\Events\UserLeft;
use Informulate\Startups\Events\UserLeftCreated;
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
		foreach ($startup->needs as $need) {
            $need->delete();
        }

        $needList = array();;
        foreach ($needs as $needData) {
            $tags = explode(',', $needData['skills']);
            $need = Need::create([
                'startup_id' => $startup->id,
                'skill_id' => $needData['role'],
                'quantity' => $needData['quantity'],
                'commitment' => $needData['commitment'],
                'description' => $needData['desc'],
            ]);

            $need->save();
            $this->updateCollection($need, 'tags', self::TAG_CLASS, $tags);
            $needList[] = $need;
        }
	}

	public function updateImage(Startup $startup, $image)
	{
		$image = Input::file('image');
		if (!empty($startup->image)) {
			unlink(public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $startup->image);
		}

		$newPath = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'upload';
		$newName = $startup->id . '.' . $image->getClientOriginalExtension();
		$image->move($newPath, $newName);
		$startup->image = $newName;
		$startup->save();
	}

	/**
	 * @param null $tag
	 * @param null $needs
	 * @param null $orderBy
	 * @param int $perPage
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function allActive($tag = null, $needs = null, $orderBy = null, $perPage = 12)
	{
		$results = Startup::where('published', '=', true);

		if ($tag) {
			$results->join('needs', 'startups.id', '=', 'needs.startup_id')
				->join('need_tag', 'need_tag.need_id', '=', 'needs.id')
				->join('tags', 'need_tag.tag_id', '=', 'tags.id')
				->where('tags.name', '=', $tag)
				->select('startups.*');
		}

		if ($needs) {
			$results->whereHas('needs', function ($q) use ($needs) {
				$q->where('needs.skill_id', '=', $needs);
			});
		}

		if ($orderBy) {
			$results->orderBy($orderBy);
		}

		$paginatedResults = $results->paginate($perPage);

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
		DB::insert('insert into startup_user (startup_id, user_id, status, created_at, updated_at) values (?, ?, ?, NOW() , NOW())', [
			$startup->id,
			$user->id,
			'pending',
		]);

        $startup->raise(new UserApplied($startup, $user));
	}

	/**
	 * @param User $user
	 * @param Startup $startup
	 */
	public function approveMemberRequest(User $user, Startup $startup)
	{
		DB::update('update startup_user set status = "approved" where startup_id = ? and user_id = ?', [
			$startup->id,
			$user->id
		]);

        Event::fire('Informulate.Startups.Events.UserJoined', new UserJoined($startup, $user));
	}

	/**
	 * @param User $user
	 * @param Startup $startup
	 */
	public function rejectMemberRequest(User $user, Startup $startup)
	{
		DB::update('update startup_user set status = "rejected" where startup_id = ? and user_id = ?', [
			$startup->id,
			$user->id
		]);

        Event::fire('Informulate.Startups.Events.UserDenied', new UserDenied($startup, $user));
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

		Event::fire('Informulate.Startups.Events.UserLeft', new UserLeft($startup, $user));
	}

	/**
	 * @param $object
	 * @param $property
	 * @param $class
	 * @param array $items
	 */
	private function updateCollection($object, $property, $class, array $items)
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

        $object->{$property}()->detach();
        $object->{$property}()->attach($itemList);
	}
}
