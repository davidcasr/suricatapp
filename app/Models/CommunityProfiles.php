<?php

namespace App\Models;

use Eloquent as Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class CommunityProfiles
 * @package App\Models
 * @version March 17, 2020,
 *
 * @property integer community_id
 * @property integer profile_id
 */

class CommunityProfiles extends Model implements AuditableContract
{
    use Auditable;

    public $table = 'community_profiles';

    public $fillable = [
        'community_id',
		'profile_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'community_id' => 'integer',
        'profile_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'community_id' => 'required',
        'profile_id' => 'required',
    ];

    public function communities()
    {
        return $this->hasMany(Community::class);
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
