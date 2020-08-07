<?php
namespace App\Models;
use Eloquent as Model;
use JWTAuth;
use willvincent\Rateable\Rateable;

class Ad extends Model {
	use Rateable;
	public $fillable = [
		'name',
		'body',
		'status',
		'ad_type',
		'contact_types',
		'price',
		'city_id',
		'user_id',
		'category_id',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'status' => 'string',
		'ad_type' => 'string',
		'price' => 'decimal:2',
		'city_id' => 'integer',
		'user_id' => 'integer',
		'category_id' => 'integer',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required|string',
		'body' => 'required|string',
		'contact_types' => 'required|array',
		'city_id' => 'required|integer',
		'category_id' => 'required|integer',
		'ad_type' => 'required|string|in:sell,buy',
	];

	public function getContactTypesAttribute($value) {
		return ($value) ? json_decode($value) : null;
	}

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

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function category() {
		return $this->hasOne(Category::class, 'id', 'category_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}
/**
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 **/
	public function images() {
		return $this->hasMany(File::class, 'relation_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 **/
	public function comments() {
		return $this->hasMany(Comment::class);
	}

	public function isFav($guard = 'api') {
		try {
			$user = auth($guard)->user();
			if ($user) {
				$getFavOfUser = $user->favorite()->where('ad_id', $this->id)->first();
				return ($getFavOfUser) ? true : false;
			} else {
				return false;
			}

		} catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
			return false;
		}
	}
}
