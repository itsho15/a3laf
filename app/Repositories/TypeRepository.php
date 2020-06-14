<?php

namespace App\Repositories;

use App\Models\Type;
use App\Repositories\BaseRepository;

/**
 * Class TypeRepository
 * @package App\Repositories
 * @version June 8, 2020, 6:16 am UTC
 */

class TypeRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'name',
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
		return Type::class;
	}

	public function create($input) {
		$model = $this->model->newInstance($input);
		$translations = [
			'en' => $input['name'],
			'ar' => $input['name_ar'],
		];

		$model->setTranslations('name', $translations);
		$model->save();
		return $model;
	}

	public function update($input, $id) {
		$query = $this->model->newQuery();
		$model = $query->findOrFail($id);
		$model->fill($input);
		$translations = [
			'en' => $input['name'],
			'ar' => $input['name_ar'],
		];
		$model->setTranslations('name', $translations);
		$model->save();

		return $model;
	}
}
