<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class State
 * @package App\Models
 * @version May 21, 2020, 1:18 pm UTC
 *
 * @property string $name
 * @property integer $country_id
 * @property integer $city_id
 */
use Spatie\Translatable\HasTranslations;

class State extends Model {
	use HasTranslations;
	public $table = 'states';

	public $translatable = ['name'];

	public $fillable = [
		'name',
		'country_id',
		'city_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'country_id' => 'integer',
		'city_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required|string',
		'country_id' => 'required|integer',
		'city_id' => 'required|integer',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function country() {
		return $this->hasOne(Country::class, 'id', 'country_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function city() {
		return $this->hasOne(City::class, 'id', 'city_id');
	}

}
