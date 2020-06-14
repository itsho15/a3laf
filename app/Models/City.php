<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class City
 * @package App\Models
 * @version May 21, 2020, 1:10 pm UTC
 *
 * @property \App\Models\Country $country
 * @property integer $name
 * @property integer $country_id
 */
use Spatie\Translatable\HasTranslations;

class City extends Model {
	use HasTranslations;
	public $table = 'cities';

	public $translatable = ['name'];
	public $fillable = [
		'name',
		'country_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'integer',
		'country_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required|string',
		'country_id' => 'required|integer',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function country() {
		return $this->hasOne(Country::class, 'id', 'country_id');
	}

	public function states() {
		return $this->hasMany(State::class);
	}
}
