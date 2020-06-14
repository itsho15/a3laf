<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Message
 * @package App\Models
 * @version March 17, 2020, 8:28 pm UTC
 *
 * @property integer id
 * @property string content
 * @property integer conversation_id
 * @property integer user_id
 */
class Message extends Model {

	public $fillable = [
		'id',
		'content',
		'conversation_id',
		'user_id',
		'type',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'conversation_id' => 'integer',
		'user_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'content' => 'required',
	];

	public function conversation() {
		return $this->belongsTo('App\Models\Conversation');
	}

	public function getContentAttribute($content) {
		return ($this->type == 'image' || $this->type == 'voice') ? \Storage::url($content) : $content;
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

}
