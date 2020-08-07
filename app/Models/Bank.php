<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Bank
 * @package App\Models
 * @version June 13, 2020, 3:31 pm UTC
 *
 * @property string $name
 */
use Spatie\Translatable\HasTranslations;

class Bank extends Model {
	use HasTranslations;
	public $translatable = ['name'];
	public $fillable = [
		'name',
		'image'
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

	public function accounts() {
		return $this->hasMany(Account::class);
	}

}
