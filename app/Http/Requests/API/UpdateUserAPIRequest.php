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
			'email' => 'sometimes|nullable|string|email|max:255|unique:users,email,'.$this->user()->id,
			'password' => 'sometimes|nullable|string|min:6',
			'phone' => 'sometimes|nullable|string|unique:users,phone,'.$this->user()->id,
		];

		return $rules;
	}
}
