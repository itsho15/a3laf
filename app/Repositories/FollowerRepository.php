<?php

namespace App\Repositories;

use App\Models\Follower;
use App\Repositories\BaseRepository;
use JWTAuth;

/**
 * Class FollowerRepository
 * @package App\Repositories
 * @version June 9, 2020, 6:35 am UTC
 */

class FollowerRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'user_id',
		'follower_id',
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
		return Follower::class;
	}

	public function create($input) {
		if (isset($input['follower_id'])) {
			$input['follower_id'] = $input['follower_id'];
		} else {
			$input['follower_id'] = JWTAuth::user()->id;
		}

		$model = $this->model->firstOrCreate($input);
		$model->save();
		return $model;
	}

	public function update($input, $id) {
		if (isset($input['follower_id'])) {
			$input['follower_id'] = $input['follower_id'];
		} else {
			$input['follower_id'] = JWTAuth::user()->id;
		}

		$query = $this->model->newQuery();
		$model = $query->findOrFail($id);
		$model->fill($input);

		$model->save();

		return $model;
	}
}
