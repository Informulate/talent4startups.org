<?php namespace Informulate\Stages;

use Eloquent;

class Stage extends Eloquent
{
	/**
	 * Fields that are mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['name'];
}
