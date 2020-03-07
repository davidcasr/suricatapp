<?php

namespace App\Repositories;

use App\Models\Feature;
use App\Repositories\BaseRepository;

/**
 * Class FeatureRepository
 * @package App\Repositories
 * @version March 7, 2020, 5:16 pm -05
*/

class FeatureRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Feature::class;
    }
}
