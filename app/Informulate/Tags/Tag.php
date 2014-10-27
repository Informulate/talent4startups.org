<?php namespace Informulate\Tags;

use Eloquent;
use Informulate\Projects\Project;
class Tag extends Eloquent {
	
	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['tag_id'];


	 /**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function projects()
	{
		return $this->belongsToMany('Informulate\Projects\Project');
	}
	
	 /**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('Informulate\Users\Profile');
	}



	/**
	 * Fetch project's tags from storage
	 * @param Object Project
	 * @return tag ids
	 */
	public static function listProjectTags(Project $project){

		$tags = $project->tags;

		return $tags->lists('id'); 
	}	

	/**	
	* add project's tags
	* @param Object Project,array tags
	*/
	public static function newProjectTags(Project $project,$tags){
		if(sizeof($tags)>0){
			// if user selected tags
			foreach($tags as $tagID){
			 $project->tags()->attach($project['id'], array('tag_id' => $tagID));
			}
		}
	}

	/**	
	* Update project's tags
	* @param Object Project,array tags
	*/
	public static function updateProjectTags(Project $project,$tags){
		Project::find($project['id'])->tags()->detach();// remove all tags of project
		Tag::newProjectTags($project,$tags); //add new tags
	}

	/**
	 * fetch user profile tags/skills
	 * @param Array $profile
	 * @return array tags
	 */
	public static function getUserProfileTags($profile){
		$tags = $profile->tags;
		return $tags->lists('id');
	}
	
	/* add profile skills to profile_tags
	 * @param Object $profile, array $tags
	 */
	public static function newProfileTags($profile,$tags){
		if(sizeof($tags)>0){
			// if user selected tags
			foreach($tags as $tagID){
			 $profile->tags()->attach($profile['id'], array('tag_id' => $tagID));
			}
		}
	}
	

}
