<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Feature
 * @package App\Models
 * @version March 7, 2020, 5:16 pm -05
 *
 * @property string name
 * @property string description
 */
class Feature extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'features';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
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
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:250'
    ];

    public function people()
    {
        return $this->belongsToMany(Person::class, 'feature_people');
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'feature_people');
    }

     public function scopeQFeature($query, $user_id)
    {
        return $query
            ->join('feature_people','feature_people.feature_id', '=','features.id')
            ->join('communities', 'feature_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->get()
            ->count();
    }
}
