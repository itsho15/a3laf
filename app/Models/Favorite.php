<?php

namespace App\Models;

use Eloquent as Model;

class Favorite extends Model {

	public $table = 'favorites';

	public $fillable = [
		'ad_id',
		'user_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'ad_id' => 'integer',
		'user_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'ad_id' => 'required|integer',
		'user_id' => 'required|integer',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function Ad() {
		return $this->hasOne(Ad::class, 'id', 'ad_id');
	}

}
