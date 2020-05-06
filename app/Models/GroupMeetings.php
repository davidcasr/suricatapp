<?php

namespace App\Models;

use Eloquent as Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class GroupMeetings
 * @package App\Models
 * @version May 04, 2020,
 *
 * @property integer group_id
 * @property integer meeting_id
 */

class GroupMeetings extends Model implements AuditableContract
{
    use Auditable;

    public $table = 'group_meetings';

    public $fillable = [
        'meeting_id',
		'group_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'meeting_id' => 'integer',
        'group_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'meeting_id' => 'required',
        'group_id' => 'required',
    ];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
