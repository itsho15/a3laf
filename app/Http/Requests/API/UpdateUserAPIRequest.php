<?php

namespace App\Http\Requests\API;

use App\User;
use InfyOm\Generator\Request\APIRequest;

class UpdateUserAPIRequest extends APIRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		$rules = [
			'name' => 'required|string',
			'email' => 'required|string',
			'city_id' => 'required|integer|exists:cities,id',
			'password' => 'sometimes|nullable|string',
		];

		return $rules;
	}
}
