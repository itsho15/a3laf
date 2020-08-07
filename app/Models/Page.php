<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Page
 * @package App\Models
 * @version July 15, 2020, 4:04 am UTC
 *
 * @property string $title
 * @property string $slug
 * @property string $body
 */
use Spatie\Translatable\HasTranslations;

class Page extends Model {
	use HasTranslations;
	public $translatable = ['title', 'body'];

	public $fillable = [
		'title',
		'slug',
		'type',
		'body',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'title' => 'string',
		'type' => 'string',
		'slug' => 'string',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'title' => 'required|string',
		'slug' => 'required|string',
		'type' => 'required|string',
		'body' => 'required|string',
	];

}
