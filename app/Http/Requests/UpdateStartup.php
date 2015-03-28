<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateStartup extends Request {

	public $uniqueIdException;

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|unique:startups,name,' . $this->request->get('startup_id'),
			'description' => ['required', 'max: 1000'],
			'video' => ['Regex:/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i'],
			'needs' => 'required'
		];
	}
}
