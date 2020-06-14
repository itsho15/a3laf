<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use willvincent\Rateable\Rateable;

class User extends Authenticatable implements JWTSubject {
	use Notifiable, HasRoles, Rateable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'type_name', 'licenseـnumber', 'licenseـimage', 'means_of_communication', 'civil_registry', 'phone', 'email', 'password', 'status', 'type_id', 'city_id',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims() {
		return [];
	}

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier() {
		return $this->getKey();
	}
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required|string',
		'email' => 'required|string',
		'password' => 'required|string',
	];

	public function city() {
		return $this->belongsTo('App\Models\City');
	}

	public function ads() {
		return $this->hasMany('App\Models\Ad');
	}

	public function type() {
		return $this->belongsTo('App\Models\Type');
	}

	public function comments() {
		return $this->hasMany('App\Models\Comment');
	}

	public function favorite() {
		return $this->hasMany('App\Models\Favorite');
	}

	public function followers() {
		return $this->hasMany('App\Models\Follower', 'follower_id', 'id');
	}

	public function following() {
		return $this->hasMany('App\Models\Follower', 'user_id', 'id');
	}
}
