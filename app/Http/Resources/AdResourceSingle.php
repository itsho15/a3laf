<?php

namespace App\Http\Resources;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Builder;
use JWTAuth;
class AdResourceSingle extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
       
	    $data =  [
			'id' => $this->id,
			'name' => $this->name,
			'body' => $this->body,
			'ad_type' => $this->ad_type,
			'contact_types' => $this->contact_types,
			'price' => number_format($this->price, 2),
			'city' => $this->city,
			'averageRating' => $this->averageRating,
			'ratings' => $this->ratings,
			'isFav' => $this->isFav(),
			'user' => $this->user,
			'category' => $this->category,
			'images' => $this->images,
			'comments' => ($this->comments) ? CommentResource::collection($this->comments) : [],
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
		];
        
        return $data;
	}
}
