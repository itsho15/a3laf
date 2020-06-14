<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\BaseRepository;

/**
 * Class CityRepository
 * @package App\Repositories
 * @version May 21, 2020, 1:10 pm UTC
 */

class CityRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'name',
		'country_id',
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
		return City::class;
	}

	public function create($input) {

		if (request()->hasFile('image')) {
			$input['image'] = up()->upload([
				'file' => 'image',
				'path' => 'cities',
				'upload_type' => 'single',
				'delete_file' => '',
			]);
		}

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
		if (request()->hasFile('image')) {
			$input['image'] = up()->upload([
				'file' => 'image',
				'path' => 'cities',
				'upload_type' => 'single',
				'delete_file' => $model->image,
			]);
		}

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
