<?php namespace Informulate\Describes;

use Eloquent;
use Informulate\Projects\Project;
class Describe extends Eloquent {

protected $table = 'talentdescribes';	
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function projects()
	{
		return $this->belongsToMany('Informulate\Projects\Project');
	}

	/**
	* add project's describes
	* @param Object Project,array describes
	*/
	public static function newProjectDescribes(Project $project,$describes){
		if(sizeof($describes)>0){
			// if user selected describes
			foreach($describes as $describeID){
			 $project->describes()->attach($project['id'], array('describe_id' => $describeID));
			}
		}
	}


	/**
	* Update project's describes
	* @param Object Project,array describes
	*/
	public static function updateProjectDescribes(Project $project,$describes){
		Project::find($project['id'])->describes()->detach();// remove all describes of project
		Describe::newProjectDescribes($project,$describes); //add new describes
	}

	/**
	 * Fetch all describes of talent from storage
	 * @return tag-ids,name
	 */
	public function listDescribes(){
	   $describes = Describe::lists('name','id');
		return $describes;
	}
 
}
