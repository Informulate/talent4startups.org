<?php namespace Informulate\Stages;

use Eloquent; 
use Informulate\Users\Profile;
class Stage extends Eloquent {
	
	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['name'];
	/**
	 * Fetch all stages from storage
	 * @return stage-ids,name
	 */
	public function listStages(){
	   $stages = Stage::lists('name','id');
		return $stages;
	}

}
