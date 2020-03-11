<?php

namespace App\Repositories\Administrator;

use App\Models\Plan;
use App\Repositories\BaseRepository;

/**
 * Class PlanRepository
 * @package App\Repositories
 * @version January 13, 2020, 7:29 pm -05
*/

class PlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'identification',
        'name',
        'price',
        'q_users',
        'q_administrators',
        'q_communities'
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
        return Plan::class;
    }
}
