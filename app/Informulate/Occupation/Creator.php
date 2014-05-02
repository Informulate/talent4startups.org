<?php
/**
 * Created by PhpStorm.
 * User: jesusOmar
 * Date: 5/2/14
 * Time: 2:50 PM
 */

namespace Informulate\Occupation;

use Ivanlemeshev\Laravel4CyrillicSlug\Facades\Slug;
use Occupation;
use OccupationController;
use Validator;

/**
 * Class Creator
 * @package Informulate\Occupation
 */
class Creator
{

	/**
	 * @var OccupationController $listener
	 */
	protected $listener;

	/**
	 * @param OccupationController $listener
	 */
	function __construct(OccupationController $listener)
	{
		$this->listener = $listener;
	}

	/**
	 * @param $input
	 * @return mixed
	 */
	public function create($input)
	{
		$validation = Validator::make($input, ['name' => 'required']);

		if ($validation->fails()) {
			return $this->listener->occupationCreationFails($validation->messages());
		}

		$input['slug'] = Slug::make($input['name']);

		Occupation::create($input);

		return $this->listener->occupationCreationSucceeds();
	}
} 
