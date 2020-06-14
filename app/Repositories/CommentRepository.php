<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use JWTAuth;

/**
 * Class CommentRepository
 * @package App\Repositories
 * @version June 9, 2020, 6:30 am UTC
 */

class CommentRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'body',
		'user_id',
		'ad_id',
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
		return Comment::class;
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
