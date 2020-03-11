<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Gen_Group
 * @package App\Models
 * @version January 3, 2020, 11:06 am -05
 *
 * @property string group_cod
 * @property string group_description
 * @property integer enabled
 */
class GenGroup extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'gen_groups';    

    protected $dates = ['deleted_at'];

    public $fillable = [
        'group_cod',
        'group_description',
        'enabled'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'group_cod' => 'string',
        'group_description' => 'string',
        'enabled' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'group_cod' => 'required',
        'group_description' => 'required',
        'enabled' => 'required'
    ];

    public function genList()
    {
        return $this->belongsTo(GenList::class, 'group_id');
    }
    
}
