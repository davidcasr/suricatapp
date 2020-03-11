<?php

namespace App\Repositories\Administrator;

use App\Models\GenGroup;
use App\Repositories\BaseRepository;

/**
 * Class GenGroupRepository
 * @package App\Repositories
 * @version January 3, 2020, 11:06 am -05
*/

class GenGroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'group_cod',
        'group_description',
        'enabled'
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
        return GenGroup::class;
    }
}
