<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use App\User;
use App\Person;

/**
 * Class Community
 * @package App\Models
 * @version March 6, 2020, 4:58 pm -05
 *
 * @property integer identification
 * @property string name
 * @property string description
 * @property string address
 * @property number latitude
 * @property number longitude
 */
class Community extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'communities';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'identification',
        'name',
        'description',
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
        'identification' => 'string',
        'name' => 'string',
        'description' => 'string',
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
        'identification' => 'nullable|max:100',
        'name' => 'required|max:250',
        'description' => 'nullable',
        'address' => 'nullable',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_users');
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'community_people');
    }

    public function scopeQCommunities($query, $user_id, $community_id)
    {
        return $query
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->where('community_users.community_id', $community_id)
            ->get()
            ->count();
    }

    public function scopeCommunities($query, $user_id)
    {
        return $query
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->select('communities.*')
            ->get();
    }
    
}
