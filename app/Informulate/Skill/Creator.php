<?php
/**
 * Created by PhpStorm.
 * User: jesusOmar
 * Date: 5/2/14
 * Time: 2:50 PM
 */

namespace Informulate\Skill;

use Ivanlemeshev\Laravel4CyrillicSlug\Facades\Slug;
use SkillSet;
use SkillSetController;
use Validator;

/**
 * Class Creator
 * @package Informulate\Skill
 */
class Creator
{

	/**
	 * @var SkillSetController $listener
	 */
	protected $listener;

	/**
	 * @param SkillSetController $listener
	 */
	function __construct(SkillSetController $listener)
	{
		$this->listener = $listener;
	}

	/**
	 * @param $input
	 * @return mixed
	 */
	public function create($input)
	{
		$validation = Validator::make($input, SkillSet::getValidations());

		if ($validation->fails()) {
			return $this->listener->skillSetCreationFails($validation->messages());
		}

		$input['slug'] = Slug::make($input['name']);

		SkillSet::create($input);

		return $this->listener->skillSetCreationSucceeds();
	}
}
