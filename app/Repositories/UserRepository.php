<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\User;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version November 23, 2019, 11:36 am UTC
 */

class UserRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'name',
		'email',
		'password',
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
		return User::class;
	}

	public function create($input) {

		$input['password'] = bcrypt($input['password']);
		if (request()->hasFile('avatar')) {
			$input['avatar'] = up()->upload([
				'file' => 'avatar',
				'path' => 'avatars',
				'upload_type' => 'single',
				'delete_file' => '',
			]);
		}

		$model = $this->model->newInstance($input);
		$model->save();
		return $model;
	}

	public function update($input, $id) {
		$query = $this->model->newQuery();

		$model = $query->findOrFail($id);
		if (request()->hasFile('avatar')) {

			$input['avatar'] = up()->upload([
				'file' => 'avatar',
				'path' => 'avatars',
				'upload_type' => 'single',
				'delete_file' => $model->avatar,
			]);
		}

		if (!request('password')) {
			$input['password'] = $model->password;
		} else {
			$input['password'] = bcrypt($input['password']);
		}

		$model->fill($input);
		$model->save();

		return $model;
	}
}
