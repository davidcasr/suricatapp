<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use App\Models\Community;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'first_name', 
        'last_name', 
        'username', 
        'email', 
        'password',
        'phone',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'nullable',
        'first_name' => 'nullable|string|max:255', 
        'last_name' => 'nullable|string|max:255', 
        'username' => 'required|string|max:255', 
        'email' => 'required|string|email|max:255|unique:users', 
        'password' => 'required|string|min:8|confirmed',
        'phone' => 'nullable|string|max:100',
        'status' => 'required|integer'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function setPasswordAttribute($value)
    {
        if($value != null)
        {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_users');
    }

    public function scopeInfoPlan($query, $user_id)
    {
        return $query
            ->join('plan_users', 'plan_users.user_id', '=', 'users.id')
            ->join('plans', 'plan_users.plan_id','=', 'plans.id')
            ->where('plan_users.user_id', $user_id)
            ->where('plan_users.status', 1);
    }
}
