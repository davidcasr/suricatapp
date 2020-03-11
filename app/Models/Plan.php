<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Plan
 * @package App\Models
 * @version January 13, 2020, 7:29 pm -05
 *
 * @property string identification
 * @property string name
 * @property number price
 * @property integer q_users
 * @property integer q_administrators
 * @property integer q_communities
 */
class Plan extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'plans';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'identification',
        'name',
        'price',
        'q_users',
        'q_administrators',
        'q_communities'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'identification' => 'string',
        'name' => 'string',
        'price' => 'double',
        'q_users' => 'integer',
        'q_administrators' => 'integer',
        'q_communities' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'identification' => 'required',
        'name' => 'required',
        'price' => 'nullable',
        'q_users' => 'required',
        'q_administrators' => 'required',
        'q_communities' => 'required'
    ];

    public function plan_user()
    {
        return $this->hasMany(PlanUser::class, 'plan_id', 'id');
    }
    
}
