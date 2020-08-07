<?php

namespace App\Repositories;

use App\Models\Page;
use App\Repositories\BaseRepository;

/**
 * Class PageRepository
 * @package App\Repositories
 * @version July 15, 2020, 4:04 am UTC
 */

class PageRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'title',
		'slug',
		'body',
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
		return Page::class;
	}

	public function create($input) {
		$model = $this->model->newInstance($input);
		$title = [
			'en' => $input['title'],
			'ar' => $input['title_ar'],
		];
		$body = [
			'en' => $input['body'],
			'ar' => $input['body_ar'],
		];

		$model->setTranslations('title', $title);
		$model->setTranslations('body', $body);
		$model->save();
		return $model;
	}

	public function update($input, $id) {
		$query = $this->model->newQuery();
		$model = $query->findOrFail($id);
		$model->fill($input);
		$title = [
			'en' => $input['title'],
			'ar' => $input['title_ar'],
		];
		$body = [
			'en' => $input['body'],
			'ar' => $input['body_ar'],
		];
		$model->setTranslations('title', $title);
		$model->setTranslations('body', $body);
		$model->save();
		return $model;
	}
}
