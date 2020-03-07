<?php

namespace App\Repositories;

use App\Models\Community;
use App\Repositories\BaseRepository;

/**
 * Class CommunityRepository
 * @package App\Repositories
 * @version March 6, 2020, 4:58 pm -05
*/

class CommunityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'identification',
        'name',
        'description',
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
        return Community::class;
    }
}
