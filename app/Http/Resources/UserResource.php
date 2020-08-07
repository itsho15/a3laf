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
			'averageRating' => $this->averageRating,
			'license_number' => ($this->license_number) ? $this->license_number : '',
			'license_image' => ($this->license_image) ? $this->license_image : '',
			'means_of_communication' => ($this->means_of_communication) ? $this->means_of_communication : '',
			'civil_registry' => ($this->civil_registry) ? $this->civil_registry : '',
			'civil_registry' => ($this->civil_registry) ? $this->civil_registry : '',
			'phone' => ($this->phone == null) ? '' : $this->phone,
			'device_id' => ($this->device_id == null) ? '' : $this->device_id,
			'lat' => ($this->lat == null) ? '' : $this->lat,
			'lng' => ($this->lng == null) ? '' : $this->lng,
			'type' => $this->type,
			'role' => ($this->roles()->count() > 0) ? $this->roles()->first()->name : 'user',
			'city' => $this->city,
			'status' => $this->status,
			'phone_verified_at' => $this->phone_verified_at,
		];

		return $data;
	}
}
