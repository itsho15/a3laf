<?php

namespace App\Http\Resources;

use App;
use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		$data = [
			'id' => $this->id,
			'name' => $this->name,
			'phone' => $this->phone,
			'lat' => $this->lat,
			'lng' => $this->lng,
			'location_name' => $this->location_name,
			'owner_name' => $this->owner_name,
			'details' => $this->details,
			'primary_image' => $this->primary_image,
			'start_price' => $this->start_price,
			'category' => $this->category,
			'images' => $this->images,
			'offers' => $this->offers()->with('user')->paginate(10),
			'user' => $this->user,
			'city' => $this->city,
			'country' => $this->country,
			'status' => $this->status,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];

		return $data;
	}
}
