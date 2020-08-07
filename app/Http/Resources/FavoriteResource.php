<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AdResource;
class FavoriteResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			//'id' => $this->id,
			//'user' => $this->user,
			'count' => $this->count(),
			'ad' => new AdResource($this->ad),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
