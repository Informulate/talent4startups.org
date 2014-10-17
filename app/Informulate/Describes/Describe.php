<?php namespace Informulate\Describes;

use Eloquent;
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
	 * Fetch all describes of talent from storage
	 * @return tag-ids,name
	 */
	public function listDescribes(){
	   $describes = Describe::lists('name','id');
		return $describes;
	}
 
}
