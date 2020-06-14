<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest {

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
		return [
			'name_ar' => 'required|string',
			'name' => 'required|string',
			'min_price' => 'required|numeric|min:50',
			'max_price' => 'required|numeric|gt:min_price',
		];
	}
}
