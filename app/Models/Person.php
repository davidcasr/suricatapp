<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Person
 * @package App\Models
 * @version March 6, 2020, 7:33 pm -05
 *
 * @property string identification
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property integer sex
 * @property string address
 * @property string birth
 * @property string city
 * @property string country
 * @property string phone
 * @property string photo
 */
class Person extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    public $table = 'people';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'identification',
        'first_name',
        'last_name',
        'email',
        'sex',
        'address',
        'birth',
        'city',
        'country',
        'phone',
        'photo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'identification' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'sex' => 'integer',
        'address' => 'string',
        'birth' => 'date',
        'city' => 'string',
        'country' => 'integer',
        'phone' => 'string',
        'photo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'identification' => 'required|max:50',
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|string|unique:people',
        'sex' => 'required',
        'address' => 'nullable|max:250',
        'birth' => 'nullable|date',
        'city' => 'nullable',
        'country' => 'required',
        'phone' => 'nullable',
        'photo' => 'nullable'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_people');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_people');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'community_people');
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'community_people');
    }

    public function genlist()
    {
        return $this->belongsTo(GenList::class, 'sex', 'id');
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function scopeQPeople($query, $user_id, $person_id)
    {
        return $query
            ->join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $user_id)
            ->where('community_people.person_id', $person_id)
            ->get()
            ->count();
    }

    public function scopePeoplePerCommunity($query, $user_id)
    {
        return $query
            ->join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->select('people.*')
            ->where('community_users.user_id', $user_id)
            ->get();
    }
    
}
