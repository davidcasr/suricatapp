<?php

namespace App\Repositories;

use App\Models\Assistant;
use App\Repositories\BaseRepository;

/**
 * Class AssistantRepository
 * @package App\Repositories
 * @version March 9, 2020, 7:09 pm -05
*/

class AssistantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'person_id',
        'group_id',
        'meeting_id',
        'confirmation'
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
        return Assistant::class;
    }
}
