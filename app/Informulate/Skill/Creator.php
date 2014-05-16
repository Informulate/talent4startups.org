<?php
/**
 * Created by PhpStorm.
 * User: jesusOmar
 * Date: 5/2/14
 * Time: 2:50 PM
 */

namespace Informulate\Skill;

use Ivanlemeshev\Laravel4CyrillicSlug\Facades\Slug;
use Skill;
use SkillController;
use Validator;

/**
 * Class Creator
 * @package Informulate\Skill
 */
class Creator
{

	/**
	 * @var SkillController $listener
	 */
	protected $listener;

	/**
	 * @param SkillController $listener
	 */
	function __construct(SkillController $listener)
	{
		$this->listener = $listener;
	}

	/**
	 * @param $input
	 * @return mixed
	 */
	public function create($input)
	{
		$validation = Validator::make($input, Skill::getValidations());

		if ($validation->fails()) {
			return $this->listener->skillCreationFails($validation->messages());
		}

		$input['slug'] = Slug::make($input['name']);

		Skill::create($input);

		return $this->listener->skillCreationSucceeds();
	}
}
