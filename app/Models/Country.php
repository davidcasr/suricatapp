<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Country
 * @package App\Models
 * @version April 21, 2020, 5:09 pm -05
 *
 * @property string name
 * @property string alpha2
 * @property string alpha3
 */

class Country extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'countries';  

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
		'name',
		'alpha2',
		'alpha3'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'alpha2' => 'string',
        'alpha3' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'alpha2' => 'nullable',
        'alpha3' => 'nullable',
    ];
}
