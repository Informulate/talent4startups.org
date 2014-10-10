<?php namespace Informulate\Forms;

use Laracasts\Validation\FormValidator;

class ResetForm extends FormValidator {

	/**
	 * Validation rules for the Password Reset form
	 *
	 * @var array
	 */
	protected $rules = [
		'old_password' => 'required',
		'new_password' => 'required',
		'password_confirmation'=> 'required'
	];
}