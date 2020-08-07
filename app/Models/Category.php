<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Category
 * @package App\Models
 * @version January 18, 2020, 2:20 pm UTC
 *
 * @property string name
 * @property string image
 * @property string type
 * @property integer parent_id
 */
use Spatie\Translatable\HasTranslations;

class Category extends Model {
	use HasTranslations;
	public $table = 'categories';

	public $translatable = ['name'];

	public $fillable = [
		'name',
		'image',
		'parent_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'parent_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [

	];

	public function childs() {
		return $this->hasMany(self::class, 'parent_id', 'id');
	}

	public function ads() {
		return $this->hasMany(Ad::class);
	}
}
