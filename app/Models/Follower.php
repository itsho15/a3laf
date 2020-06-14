<?php

namespace App\Models;
/**
 */
use Eloquent as Model;

class Follower extends Model {

	public $fillable = [
		'user_id',
		'follower_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'user_id' => 'integer',
		'follower_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'user_id' => 'required|integer',
		'follower_id' => 'required|integer',
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
	public function follower() {
		return $this->hasOne('App\User', 'id', 'follower_id');
	}

}
