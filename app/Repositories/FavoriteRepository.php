<?php

namespace App\Repositories;

use App\Models\Favorite;
use App\Repositories\BaseRepository;
use JWTAuth;

/**
 * Class FavoriteRepository
 * @package App\Repositories
 * @version June 8, 2020, 10:06 am UTC
 */

class FavoriteRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'ad_id',
		'user_id',
	];

	/**
	 * Return searchable fields
	 *
	 * @return array
	 */
	public function getFieldsSearchable() {
		return $this->fieldSearchable;
	}

	/**
	 * Configure the Model
	 **/
	public function model() {
		return Favorite::class;
	}

	public function create($input) {
		if (isset($input['user_id'])) {
			$input['user_id'] = $input['user_id'];
		} else {
			$input['user_id'] = JWTAuth::user()->id;
		}
		$model = $this->model->create($input);
		$model->save();
		return $model;
	}

	public function update($input, $id) {
		if (isset($input['user_id'])) {
			$input['user_id'] = $input['user_id'];
		} else {
			$input['user_id'] = JWTAuth::user()->id;
		}

		$query = $this->model->newQuery();
		$model = $query->findOrFail($id);
		$model->fill($input);

		$model->save();

		return $model;
	}
}
