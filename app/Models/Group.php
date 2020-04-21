<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Group
 * @package App\Models
 * @version March 7, 2020, 4:24 pm -05
 *
 * @property integer parent_id
 * @property string identification
 * @property string name
 * @property string description
 */
class Group extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'groups';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'parent_id',
        'name',
        'description',
        'level'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'level' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'nullable',
        'name' => 'required|max:100',
        'description' => 'nullable|max:250',
        'level' => 'required',
    ];

    public function subgroup()
    {
        return $this->belongsTo(Group::class, 'parent_id', 'id');
    }

    public function subgroups()
    {
        return $this->hasMany(Group::class, 'parent_id', 'id');
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_groups');
    }

    public function communities_people()
    {
        return $this->belongsToMany(Community::class, 'community_people');
    }

    public function scopeQGroup($query, $user_id)
    {
        return $query
            ->join('community_groups','community_groups.group_id', '=','groups.id')
            ->join('communities', 'community_groups.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->get()
            ->count();
    }

    public function scopeGroupsByUser($query, $user_id)
    {
        return $query
            ->join('community_groups','community_groups.group_id', '=','groups.id')
            ->join('communities', 'community_groups.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->select('groups.*')
            ->get();
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($group) { 
             $group->subgroups()->each(function($subgroup) {
                $subgroup->delete(); 
             });
        });
    }
    
}
