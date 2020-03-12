<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class CommunityUsers
 * @package App\Models
 * @version March 11, 2020
 *
 * @property integer id
 * @property integer user_id
 * @property integer community_id
 */
class CommunityUsers extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'community_users';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'community_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'community_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'community_id' => 'required',
    ];

    public function scopeQCommunityUsers($query, $user_id)
    {
        return $query
            ->where('community_users.user_id', $user_id)
            ->get()
            ->count();
    }
        
}
