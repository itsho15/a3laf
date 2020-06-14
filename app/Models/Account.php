<?php

namespace App\Models;

use Eloquent as Model;

class Account extends Model {

	public $fillable = [
		'number',
		'iban',
		'note',
		'bank_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'number' => 'string',
		'iban' => 'string',
		'note' => 'string',
		'bank_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'number' => 'required|string',
		'iban' => 'required|string',
		'note' => 'required|string',
		'bank_id' => 'required|integer',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function bank() {
		return $this->hasOne(Bank::class, 'id', 'bank_id');
	}

}
