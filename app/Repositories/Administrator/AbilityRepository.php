<?php

namespace App\Repositories\Administrator;

use Silber\Bouncer\Database\Ability;  
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version October 17, 2019, 8:12 pm UTC
*/

class AbilityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name', 
        'title',
        'entity_id',
        'entity_type',
        'only_owned',
        'options',
        'scope'
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
        return Ability::class;
    }
}
