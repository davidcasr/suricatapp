<?php

namespace App\Repositories\Administrator;

use App\Models\GenList;
use App\Repositories\BaseRepository;

/**
 * Class GenListRepository
 * @package App\Repositories
 * @version January 13, 2020, 3:01 pm -05
*/

class GenListRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item_id',
        'item_description',
        'item_cod',
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
        return GenList::class;
    }
}
