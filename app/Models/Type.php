<?php

namespace App\Models;

use Eloquent as Model;
use Spatie\Translatable\HasTranslations;

class Type extends Model {
	use HasTranslations;
	public $translatable = ['name'];
	public $fillable = [
		'name',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required|string',
	];

}
