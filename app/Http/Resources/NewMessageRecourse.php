<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewMessageRecourse extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'message' => $this->content,
			'message_id' => $this->id,
			'message_to' => $this->conversation->to,
		];
	}
}
