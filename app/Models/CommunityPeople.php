<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class CommunityPeolple
 * @package App\Models
 * @version March 12, 2020,
 *
 * @property integer community_id
 * @property integer person_id
 * @property integer group_id
 * @property integer profile_id
 */

class CommunityPeople extends Model implements AuditableContract
{
    use Auditable;

    public $table = 'community_people';

    public $fillable = [
        'community_id',
		'person_id',
		'group_id',
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
        'person_id' => 'integer',
        'group_id' => 'integer',
        'profile_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'community_id' => 'required',
        'person_id' => 'required',
        'group_id' => 'nullable',
        'profile_id' => 'nullable',
    ];

    public function communities()
    {
        return $this->hasMany(Community::class, 'id', 'community_id');
    }

    public function people()
    {
        return $this->hasMany(Person::class, 'id', 'person_id');
    }
}
