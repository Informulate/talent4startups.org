<?php namespace Informulate\Skills;

use Eloquent; 
use Informulate\Users\Profile;
class Skill extends Eloquent {
	
	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['name'];


	 /**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('Informulate\Users\User');
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
	* add user's skills
	* @param Object Project,array skills
	*/
	public static function newUserSkills(User $user,$skills){
		if(sizeof($skills)>0){
			// if user selected skills
			foreach($skills as $skillID){
			 $user->skill()->attach($user['id'], array('skill_id' => $skillID));
			}
		}
	}

}
