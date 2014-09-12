<?php
class Project extends Eloquent
{
	protected $fillable =
	[
		'user_id',
		'name',
		'description'
	];

	/**
	 * Returns a list of projects owned by the curent user
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public static function myProjects()
	{
		return Project::where('user_id', '=', Auth::user()->id)->get();
	}
}
