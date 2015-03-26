<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileRepository
{
	const TAG_CLASS = 'Informulate\\Tags\\Tag';

	/**
	 * @param Profile $profile
	 * @return bool
	 */
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
		$items = explode(',', strtolower($tags));
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

	/**
	 * @param Profile $profile
	 */
	public function updateImage(Profile $profile)
	{
		// Upload the file to a temp folder and get the file extension
		$upload = Input::file('image');
		$extension = $upload->getClientOriginalExtension();

		// Use intervention image to create the new file with the proper dimensions
		// TODO: Instead of resize, figure out a way to maintain the aspect ratio
		$image = Image::make($upload);//->resize(150, 150);
		// Fix the new file extension
		$image->extension = $extension;
		// Prepare to move the file to the proper folder and with the proper unique name
		$newPath = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'upload';
		$newName = $profile->id . '_t.' . $image->extension;

		// Remove the existing file if needed
		if (!empty($profile->image)) {
			unlink(public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $profile->image);
		}

		// Save the image and the profile
		$image->save($newPath . '/' . $newName);
		$profile->image = $newName;
		$profile->save();
	}
}
