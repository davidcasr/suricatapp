<?php

namespace App\Repositories;

use App\Models\MeetingReport;
use App\Repositories\BaseRepository;

/**
 * Class MeetingReportRepository
 * @package App\Repositories
 * @version March 9, 2020, 3:58 pm -05
*/

class MeetingReportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'person_id',
        'meeting_id',
        'description'
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
        return MeetingReport::class;
    }
}
