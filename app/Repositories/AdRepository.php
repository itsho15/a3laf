<?php

namespace App\Repositories;

use App\Models\Ad;
use App\Repositories\BaseRepository;
use JWTAuth;

/**
 * Class AdRepository
 * @package App\Repositories
 * @version June 8, 2020, 8:40 pm UTC
 */

class AdRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'name',
		'body',
		'status',
		'ad_type',
		'contact_types',
		'price',
		'city_id',
		'user_id',
		'category_id',
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
		return Ad::class;
	}

	public function create($input) {
		$input['contact_types'] = json_encode($input['contact_types']);
		$input['user_id'] = JWTAuth::user()->id;
		$input['status'] = 'pending';
		$model = $this->model->create($input);

		if (request()->hasFile('images')) {
			up()->upload([
				'file' => 'images',
				'path' => 'ads',
				'upload_type' => 'multi',
				'delete_file' => '',
				'file_type' => 'ad',
				'relation_id' => $model->id,
			]);
		}
		$model->save();
		return $model;
	}

	public function update($input, $id) {
	    if(isset($input['contact_types'])){
	        $input['contact_types'] = json_encode($input['contact_types']);
	    }
		
		$query = $this->model->newQuery();
		$model = $query->findOrFail($id);
		$model->fill($input);
		if (request()->hasFile('images')) {
			up()->upload([
				'file' => 'images',
				'path' => 'ads',
				'upload_type' => 'multi',
				'delete_file' => '', //$model->images()->get()->toArray(),
				'file_type' => 'ad',
				'relation_id' => $model->id,
			]);
		}
		$model->save();

		return $model;
	}
}
