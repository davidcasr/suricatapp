<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Assistant
 * @package App\Models
 * @version March 9, 2020, 7:09 pm -05
 *
 * @property integer person_id
 * @property integer group_id
 * @property integer meeting_id
 * @property integer confirmation
 */
class Assistant extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'assistants';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'person_id',
        'group_id',
        'meeting_id',
        'confirmation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'person_id' => 'integer',
        'group_id' => 'integer',
        'meeting_id' => 'integer',
        'confirmation' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'person_id' => 'required',
        'group_id' => 'required',
        'meeting_id' => 'required',
        'confirmation' => 'required'
    ];

    
}