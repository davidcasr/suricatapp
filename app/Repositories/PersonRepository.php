<?php

namespace App\Repositories;

use App\Models\Person;
use App\Repositories\BaseRepository;

/**
 * Class PersonRepository
 * @package App\Repositories
 * @version March 6, 2020, 7:33 pm -05
*/

class PersonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'identification',
        'first_name',
        'last_name',
        'email',
        'sex',
        'address',
        'birth',
        'city',
        'country',
        'phone',
        'photo'
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
        return Person::class;
    }
}
