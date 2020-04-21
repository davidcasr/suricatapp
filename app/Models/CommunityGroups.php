<?php

namespace App\Models;

use Eloquent as Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class CommunityGroups
 * @package App\Models
 * @version March 17, 2020,
 *
 * @property integer community_id
 * @property integer group_id
 */

class CommunityGroups extends Model implements AuditableContract
{
    use Auditable;

    public $table = 'community_groups';

    public $fillable = [
        'community_id',
		'group_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'community_id' => 'integer',
        'group_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'community_id' => 'required',
        'group_id' => 'required',
    ];

    public function communities()
    {
        return $this->hasMany(Community::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
