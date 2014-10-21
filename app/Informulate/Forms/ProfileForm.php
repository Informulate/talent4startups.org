<?php namespace Informulate\Forms;

use Laracasts\Validation\FormValidator;

class ProfileForm extends FormValidator {

	/**
	 * Validation rules for the registration form
	 *
	 * @var array
	 */
	protected $rules = [
		'first_name' => 'required',
		'last_name' => 'required'
		,'skills' => 'required'
	];
}
