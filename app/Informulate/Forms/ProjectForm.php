<?php namespace Informulate\Forms;

use Laracasts\Validation\FormValidator;

class ProjectForm extends FormValidator {

	/**
	 * Validation rules for the registration form
	 *
	 * @var array
	 */
	protected $rules = [
		'name' => 'required',
	];
}
