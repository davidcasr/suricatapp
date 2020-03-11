<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class GenList
 * @package App\Models
 * @version January 13, 2020, 3:01 pm -05
 *
 * @property integer item_id
 * @property string item_description
 * @property string item_cod
 * @property integer enabled
 */
class GenList extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'gen_lists';  

    protected $dates = ['deleted_at'];

    public $fillable = [
        'group_id',
        'item_id',
        'item_description',
        'item_cod',
        'enabled'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'group_id' => 'integer',
        'item_id' => 'integer',
        'item_description' => 'string',
        'item_cod' => 'string',
        'enabled' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'group_id' => 'required|numeric',
        'item_id' => 'required|numeric',
        'item_description' => 'required',
        'item_cod' => 'nullable',
        'enabled' => 'required'
    ];

    
}
