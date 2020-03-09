<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Meeting
 * @package App\Models
 * @version March 9, 2020, 2:01 pm -05
 *
 * @property integer user_id
 * @property integer person_id
 * @property string name
 * @property string description
 * @property string date
 * @property string address
 * @property number latitude
 * @property number longitude
 */
class Meeting extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'meetings';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'person_id',
        'name',
        'description',
        'date',
        'address',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'person_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'date' => 'datetime',
        'address' => 'string',
        'latitude' => 'double',
        'longitude' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'person_id' => 'nullable',
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:250',
        'date' => 'required',
        'address' => 'required|string|max:100',
        'latitude' => 'nullable',
        'longitude' => 'nullable'
    ];

    
}
