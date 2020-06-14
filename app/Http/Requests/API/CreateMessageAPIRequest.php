<?php

namespace App\Http\Requests\API;

use InfyOm\Generator\Request\APIRequest;

class CreateMessageAPIRequest extends APIRequest {
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
			'conversation_id' => 'required|integer|exists:conversations,id',
			'content' => 'required',
			'type' => 'required|in:image,text,voice,video',
		];
	}
}
