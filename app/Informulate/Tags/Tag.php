<?php namespace Informulate\Tags;

use Eloquent;
use Informulate\Startups\Startup;

class Tag extends Eloquent
{

	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['tag_id'];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function startups()
	{
		return $this->belongsToMany('Informulate\Startups\Startup');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('Informulate\Users\Profile');
	}


	/**
	 * @param Startup $startup
	 * @return mixed
	 */
	public static function listStartupTags(Startup $startup)
	{

		$tags = $startup->tags;

		return $tags->lists('id');
	}

	/**
	 * @param Startup $startup
	 * @param $tags
	 */
	public static function newStartupTags(Startup $startup, $tags)
	{
		if (sizeof($tags) > 0) {
			// if user selected tags
			foreach ($tags as $tagID) {
				$startup->tags()->attach($startup['id'], array('tag_id' => $tagID));
			}
		}
	}

	/**
	 * @param Startup $startup
	 * @param $tags
	 */
	public static function updateStartupTags(Startup $startup, $tags)
	{
		Startup::find($startup['id'])->tags()->detach();// remove all tags of startup
		Tag::newStartupTags($startup, $tags); //add new tags
	}

	/**
	 * fetch user profile tags/skills
	 * @param Array $profile
	 * @return array tags
	 */
	public static function getUserProfileTags($profile)
	{
		$tags = $profile->tags;
		return $tags->lists('id');
	}

	/**
	 * @param $profile
	 * @param $tags
	 */
	public static function newProfileTags($profile, $tags)
	{
		if (sizeof($tags) > 0) {
			// if user selected tags
			foreach ($tags as $tagID) {
				$profile->tags()->attach($profile['id'], array('tag_id' => $tagID));
			}
		}
	}


}
