<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\BaseRepository;

/**
 * Class AccountRepository
 * @package App\Repositories
 * @version June 9, 2020, 6:33 am UTC
 */

class AccountRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'number',
		'iban',
		'note',
		'bank_id',
		'user_id',
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
		return Account::class;
	}

}
