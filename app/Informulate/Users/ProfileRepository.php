<?php namespace Informulate\Users;

class ProfileRepository
{
	const TAG_CLASS = 'Informulate\\Tags\\Tag';

	public function save(Profile $profile)
	{
		return $profile->save();
	}

	/**
	 * @param Profile $profile
	 * @param $tags
	 */
	public function updateSkills(Profile $profile, $tags)
	{
		$items = explode(',', $tags);
		$this->updateCollection($profile, 'tags', self::TAG_CLASS, $items);
	}

	/**
	 * @param Profile $profile
	 * @param $property
	 * @param $class
	 * @param array $items
	 */
	private function updateCollection(Profile $profile, $property, $class, array $items)
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

		$profile->{$property}()->detach();
		$profile->{$property}()->attach($itemList);
	}
}
