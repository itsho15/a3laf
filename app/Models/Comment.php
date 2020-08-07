<?php

namespace App\Models;
use Eloquent as Model;

/**
 */
class Comment extends Model {

	public $fillable = [
		'body',
		'user_id',
		'ad_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'user_id' => 'integer',
		'ad_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'body' => 'required|string',
		//'user_id' => 'required|integer',
		'ad_id' => 'required|integer',
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
