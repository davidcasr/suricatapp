<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Profile
 * @package App\Models
 * @version March 7, 2020, 5:54 pm -05
 *
 * @property string name
 * @property string description
 */
class Profile extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'profiles';
    
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

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_profiles');
    }

    public function scopeQProfile($query, $user_id)
    {
        return $query
            ->join('community_profiles','community_profiles.profile_id', '=','profiles.id')
            ->join('communities', 'community_profiles.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->get()
            ->count();
    }

    public function scopeProfilesByUser($query, $user_id)
    {
        return $query
            ->join('community_profiles','community_profiles.profile_id', '=','profiles.id')
            ->join('communities', 'community_profiles.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->select('profiles.*')
            ->get();
    }
    
}
