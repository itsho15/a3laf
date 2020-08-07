<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource {
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
			'body' => $this->body,
			'ad_type' => $this->ad_type,
			'isFav' => $this->isFav(),
			'contact_types' => $this->contact_types,
			'price' => number_format($this->price, 2),
			'averageRating' => $this->averageRating,
			'lastImage' => $this->images()->first(),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
		];

		return $data;
	}
}
