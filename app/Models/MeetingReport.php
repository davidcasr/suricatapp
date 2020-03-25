<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use App\User;

/**
 * Class MeetingReport
 * @package App\Models
 * @version March 9, 2020, 3:58 pm -05
 *
 * @property integer user_id
 * @property integer person_id
 * @property integer meeting_id
 * @property string description
 */
class MeetingReport extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'meeting_reports';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'person_id',
        'meeting_id',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'person_id' => 'integer',
        'meeting_id' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'person_id' => 'nullable',
        'meeting_id' => 'required',
        'description' => 'required'
    ];

    public function meetings()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeQMeetingReport($query, $user_id)
    {
        return $query
            ->join('meetings','meeting_reports.meeting_id', '=','meetings.id')
            ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
            ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->get()
            ->count();
    }
    
}
