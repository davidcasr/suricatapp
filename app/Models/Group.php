<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Group
 * @package App\Models
 * @version March 7, 2020, 4:24 pm -05
 *
 * @property integer parent_id
 * @property string identification
 * @property string name
 * @property string description
 */
class Group extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'groups';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'parent_id',
        'identification',
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'identification' => 'string',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'nullable',
        'identification' => 'nullable|string',
        'name' => 'required|max:100',
        'description' => 'nullable|max:250'
    ];

    
}