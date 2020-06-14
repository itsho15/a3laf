<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class File
 * @package App\Models
 * @version May 21, 2020, 10:44 pm UTC
 *
 * @property string $name
 * @property string $size
 * @property string $file
 * @property string $path
 * @property string $full_file
 * @property string $mime_type
 * @property string $file_type
 * @property string $relation_id
 */
class File extends Model {

	public $table = 'files';

	public $fillable = [
		'name',
		'size',
		'file',
		'path',
		'full_file',
		'mime_type',
		'file_type',
		'relation_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'name' => 'string',
		'size' => 'string',
		'file' => 'string',
		'path' => 'string',
		'full_file' => 'string',
		'mime_type' => 'string',
		'file_type' => 'string',
		'relation_id' => 'string',
		'id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [

	];

	public function getFullFileAttribute($value) {
		if (request()->route()->getName() != 'admin.ads.update') {
			return ($value) ? \Storage::url($value) : null;
		} else {
			return $value;
		}
	}

}
