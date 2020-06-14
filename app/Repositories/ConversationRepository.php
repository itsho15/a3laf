<?php

namespace App\Repositories;

use App\Models\Conversation;
use App\Repositories\BaseRepository;

/**
 * Class ConversationRepository
 * @package App\Repositories
 * @version June 7, 2020, 8:14 am UTC
*/

class ConversationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'offer_id',
        'order_id',
        'from_id',
        'to_id'
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
        return Conversation::class;
    }
}
