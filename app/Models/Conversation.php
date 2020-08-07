<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Conversation
 * @package App\Models
 * @version March 17, 2020, 8:09 pm UTC
 *
 * @property integer offer_id
 * @property integer order_id
 * @property integer from_id
 * @property integer to_id
 */
class Conversation extends Model {

	public $table = 'conversations';

	public $fillable = [
		'from_id',
		'to_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'from_id' => 'integer',
		'to_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'from_id' => 'required|exists:users,id',
		'to_id' => 'required|exists:users,id',
	];

	public function from() {
		return $this->belongsTo('App\User', 'from_id');
	}

	public function to() {
		return $this->belongsTo('App\User', 'to_id');
	}

	public function messages() {
		return $this->hasMany(Message::class);
	}

	public function lastMessage() {
		return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
	}

}
