<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'from_id' => $this->from_id,
			'to_id' => $this->to_id,
			'last_message' => $this->last_message,
			'messages' => ($this->messages()->count() > 0) ? $this->messages()->with('user')->paginate(100) : null,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
