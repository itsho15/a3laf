<?php

namespace App\Repositories;

use App\Models\File;
use App\Repositories\BaseRepository;

/**
 * Class FileRepository
 * @package App\Repositories
 * @version May 21, 2020, 10:44 pm UTC
*/

class FileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'size',
        'file',
        'path',
        'full_file',
        'mime_type',
        'file_type',
        'relation_id'
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
        return File::class;
    }
}
