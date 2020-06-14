<?php

namespace App\Http\Resources;

use App;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		$data = [
			'id' => $this->id,
			'name' => ($this->name == null) ? '' : $this->name,
			'email' => $this->email,
			'avatar' => ($this->avatar == null) ? '' : $this->avatar,
			'phone' => ($this->phone == null) ? '' : $this->phone,
			'averageRating' => $this->averageRating,
			'device_id' => ($this->device_id == null) ? '' : $this->device_id,
			'lat' => ($this->lat == null) ? '' : $this->lat,
			'lng' => ($this->lng == null) ? '' : $this->lng,
			'type' => $this->type,
			'city' => $this->city,
			'phone_verified_at' => $this->phone_verified_at,
		];

		return $data;
	}
}
