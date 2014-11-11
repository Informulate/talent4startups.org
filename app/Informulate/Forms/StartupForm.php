<?php namespace Informulate\Forms;

use Laracasts\Validation\FormValidator;

class StartupForm extends FormValidator
{
	/**
	 * Validation rules for the registration form
	 *
	 * @var array
	 */
	protected $rules = [
		'name' => 'required',
	];
}
