<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Country
 * @package App\Models
 * @version May 16, 2020, 1:22 am UTC
 *
 * @property string $name
 * @property string $image
 */
use Spatie\Translatable\HasTranslations;

class Country extends Model {
	use HasTranslations;
	public $translatable = ['name'];

	public $fillable = [
		'name',
		'image',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'image' => 'string',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [

	];

	public function cities() {
		return $this->hasMany(City::class);
	}

	public function states() {
		return $this->hasMany(State::class);
	}

}
