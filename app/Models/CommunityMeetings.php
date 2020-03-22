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
 * @property integer meeting_id
 */
class CommunityMeetings extends Model
{
    use Auditable;

    public $table = 'community_meetings';

    public $fillable = [
        'community_id',
		'meeting_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'community_id' => 'integer',
        'meeting_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'community_id' => 'required',
        'meeting_id' => 'required',
    ];

    public function communities()
    {
        return $this->hasMany(Community::class, 'id', 'community_id');
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'id', 'meeting_id');
    }
}
