<?php

namespace App\Repositories;

use App\Models\Country;
use App\Repositories\BaseRepository;

/**
 * Class CountryRepository
 * @package App\Repositories
 * @version January 27, 2020, 1:50 am UTC
 */

class CountryRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'name',
		'image',
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
		return Country::class;
	}

	public function create($input) {

		if (request()->hasFile('image')) {
			$input['image'] = up()->upload([
				'file' => 'image',
				'path' => 'countries',
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
				'path' => 'countries',
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
