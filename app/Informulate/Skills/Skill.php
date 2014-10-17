<?php namespace Informulate\Skills;

use Eloquent; 
use Informulate\Users\Profile;
class Skill extends Eloquent {
	
	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['name','skill_id'];

	 /**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function profiles()
	{
		return $this->belongsToMany('Informulate\Users\Profile');
	}

	/**
	 * Fetch all skills from storage
	 * @return skill-ids,name
	 */
	public function listSkill(){
	   $skills = Skill::lists('name','id');
		return $skills;
	}
	
	/**
	 * fetch user profile skills
	 * @param Object $profile
	 * @return array skills
	 */
	public static function getUserProfileSkills(Profile $profile){
		
		$skills = $profile->skills;
		return $skills->lists('id');
	}
	
	/* add profile skills to profile_skills
	 * @param Object $profile, array $sills
	 */
	public static function newProfileSkills($profile,$skills){
		if(sizeof($skills)>0){
			// if user selected tags
			foreach($skills as $skillID){
			 $profile->skills()->attach($profile['id'], array('skill_id' => $skillID));
			}
		}
	}

}
