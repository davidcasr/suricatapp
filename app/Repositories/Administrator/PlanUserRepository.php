<?php

namespace App\Repositories\Administrator;

use App\Models\PlanUser;
use App\Repositories\BaseRepository;

/**
 * Class PlanUserRepository
 * @package App\Repositories
 * @version January 14, 2020, 11:53 am -05
*/

class PlanUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'plan_id',
        'status',
        'date_activation',
        'date_deadline'
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
        return PlanUser::class;
    }
}
