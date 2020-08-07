<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Complaint
 * @package App\Models
 * @version June 29, 2020, 12:40 pm UTC
 *
 * @property string $content
 */
class Complaint extends Model {

	public $table = 'complaints';

	public $fillable = [
		'content',
		'ad_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'content' => 'required|string',
	];

	public function ad() {
		return $this->belongsTo(Ad::class);
	}

}
