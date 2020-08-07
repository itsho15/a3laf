<?php

namespace App\Repositories;

use App\Models\Complaint;
use App\Repositories\BaseRepository;

/**
 * Class ComplaintRepository
 * @package App\Repositories
 * @version June 29, 2020, 12:40 pm UTC
*/

class ComplaintRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Complaint::class;
    }
}
