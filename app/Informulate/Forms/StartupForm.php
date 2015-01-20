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
		'video' => ['Regex:/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i']
	];
}