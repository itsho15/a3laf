<?php

namespace App\Repositories;

use App\Models\Bank;
use App\Repositories\BaseRepository;

/**
 * Class BankRepository
 * @package App\Repositories
 * @version June 13, 2020, 3:31 pm UTC
 */

class BankRepository extends BaseRepository {
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
		return Bank::class;
	}

	public function create($input) {
		if (request()->hasFile('image')) {
			$input['image'] = up()->upload([
				'file' => 'image',
				'path' => 'banks',
				'upload_type' => 'single',
				'delete_file' => $model->image,
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
				'path' => 'banks',
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
