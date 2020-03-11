<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
/**
 * Class PlanUser
 * @package App\Models
 * @version January 14, 2020, 11:53 am -05
 *
 * @property integer user_id
 * @property integer plan_id
 * @property integer status
 * @property string date_activation
 * @property string date_deadline
 */
class PlanUser extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'plan_users';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'plan_id',
        'status',
        'date_activation',
        'date_deadline'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'plan_id' => 'integer',
        'status' => 'integer',
        'date_activation' => 'date',
        'date_deadline' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'plan_id' => 'required',
        'status' => 'required',
        'date_activation' => 'required',
        'date_deadline' => 'nullable'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function plans()
    {
        return $this->hasMany(Plan::class, 'id', 'plan_id');
    }
}
