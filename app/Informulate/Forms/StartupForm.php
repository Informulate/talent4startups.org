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
		'name' => 'required|unique:startups',
		'description' => ['required', 'max: 1000'],
		'video' => ['Regex:/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i'],
		'needs' => 'required'
	];

	/**
	 * @inheritdoc
	 */
	public function validate(array $formData, $uniqueIdException = null)
	{
		if ($uniqueIdException) {
			$this->rules['name'] = 'required|unique:startups,name,' . $uniqueIdException;
		}

		parent::validate($formData);
	}
}
