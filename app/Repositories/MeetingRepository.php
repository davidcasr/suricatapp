<?php

namespace App\Repositories;

use App\Models\Meeting;
use App\Repositories\BaseRepository;

/**
 * Class MeetingRepository
 * @package App\Repositories
 * @version March 9, 2020, 2:01 pm -05
*/

class MeetingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'person_id',
        'name',
        'description',
        'date',
        'address',
        'latitude',
        'longitude'
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
        return Meeting::class;
    }
}
