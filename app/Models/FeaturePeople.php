<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
/**
 * Class FeaturePeople
 * @package App\Models
 * @version January 14, 2020, 11:53 am -05
 *
 * @property integer user_id
 * @property integer plan_id
 * @property integer status
 * @property string date_activation
 * @property string date_deadline
 */
class FeaturePeople extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'feature_people';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'feature_id',
        'person_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'feature_id' => 'integer',
        'person_id' => 'integer',
        'community_id' => 'integer'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'feature_id' => 'required',
        'person_id' => 'nullable',
        'community_id' => 'required'
    ];

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

}
