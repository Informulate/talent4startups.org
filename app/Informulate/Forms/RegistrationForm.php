<?php namespace Informulate\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator
{
	/**
	 * Validation rules for the registration form
	 *
	 * @var array
	 */
	protected $rules = [
		'username' => 'required|unique:users|min:5',
		'email' => 'required|email|unique:users',
		'password' => 'required|confirmed|min:8|not_in:password,password1234,12345678,changeme',
		'type' => 'required'
	];
}
