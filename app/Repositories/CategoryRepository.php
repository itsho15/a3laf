<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version January 18, 2020, 2:20 pm UTC
 */

class CategoryRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'name',
		'image',
		'parent_id',
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
		return Category::class;
	}

	public function create($input) {

		if (request()->hasFile('image')) {
			$input['image'] = up()->upload([
				'file' => 'image',
				'path' => 'categories',
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
				'path' => 'categories',
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
