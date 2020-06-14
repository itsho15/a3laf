<?php

namespace App\Http\Requests\API;

use InfyOm\Generator\Request\APIRequest;

class UpdateAdAPIRequest extends APIRequest {
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
			'body' => 'required|string',
			'contact_types' => 'required|array',
			'city_id' => 'required|integer',
			'category_id' => 'required|integer',
			'ad_type' => 'required|string|in:sell,buy',
		];

		return $rules;
	}
}
