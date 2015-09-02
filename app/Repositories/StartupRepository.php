<?php

namespace App\Repositories;

use App\Models\Need;
use App\Models\Startup;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Input;
use App\Events\UserAppliedToJoinStartup as UserApplied;
use App\Events\UserDeniedToJoinStartup as UserDenied;
use App\Events\UserJoinedStartup as UserJoined;
use App\Events\UserLeftStartup as UserLeft;

class StartupRepository
{
	const TAG_CLASS = 'App\\Models\\Tag';
	const SKILL_CLASS = 'App\\Models\\Skill';

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
		$items = explode(',', strtolower($tags));
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
            $tags = explode(',', strtolower(array_key_exists('skills', $needData) ? $needData['skills'] : $needData['tags']));
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
	 * @param null $tags
	 * @param null $needs
	 * @param null $descriptionKeyword
	 * @param null $orderBy
	 * @param int $perPage
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function allActive($tags = null, $needs = null, $descriptionKeyword = null, $orderBy = null, $perPage = 12)
	{
		$results = Startup::where('published', '=', true)->with('owner')->with('needs')->with('tags')->with('ratings');
        $results->where('startups.description', 'LIKE', "%$descriptionKeyword%");

        if (count($tags) > 0) {
			$results->join('needs', 'startups.id', '=', 'needs.startup_id')
				->join('startup_tag', 'startup_tag.startup_id', '=', 'startups.id')
				->join('need_tag', 'need_tag.need_id', '=', 'needs.id')
                ->join('tags', function($join) {
                    $join->on('need_tag.tag_id', '=', 'tags.id')->orOn('startup_tag.tag_id', '=', 'tags.id');
                })
                ->whereIn('tags.name', $tags)
                ->groupBy('startups.id')
				->select('startups.*');
		}

		if ($needs) {
			$results->whereHas('needs', function ($q) use ($needs) {
				$q->where('needs.skill_id', '=', $needs);
			});
		}

		if ($orderBy) {
			$results->orderBy($orderBy);
		} else {
			$results->orderBy('id', 'DESC');
		}

		$paginatedResults = $results->paginate($perPage);

		if ($needs or $tags or $descriptionKeyword) {
			$tags = is_array($tags) ? implode($tags, ',') : '';
			$paginatedResults->appends(['needs' => $needs, 'tags' => $tags, 'description' => $descriptionKeyword]);
		}

		return $paginatedResults;
	}

	/**
	 * @param User $user
	 * @param Startup $startup
	 * @param bool $fireEvent
	 */
	public function addMemberRequest(User $user, Startup $startup, $fireEvent = true)
	{
		DB::insert('insert into startup_user (startup_id, user_id, status, created_at, updated_at) values (?, ?, ?, NOW() , NOW())', [
			$startup->id,
			$user->id,
			'pending',
		]);

		if ($fireEvent) {
			Event::fire(new UserApplied($startup, $user));
		}
	}

	/**
	 * @param User $user
	 * @param Startup $startup
	 * @param bool $fireEvent
	 */
	public function approveMemberRequest(User $user, Startup $startup, $fireEvent = true)
	{
		DB::update('update startup_user set status = "approved" where startup_id = ? and user_id = ?', [
			$startup->id,
			$user->id
		]);

		if ($fireEvent) {
			Event::fire(new UserJoined($startup, $user));
		}
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

        Event::fire('App.Events.UserDenied', new UserDenied($startup, $user));
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

		Event::fire('App.Events.UserLeft', new UserLeft($startup, $user));
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
