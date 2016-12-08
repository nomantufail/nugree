<?php

namespace App\Models\Sql;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'f_name', 'l_name',  'password', 'email', 'country_id', 'membership_plan_id'
    ];

    public function agencies()
    {
        return $this->hasMany('App\Models\Sql\Agency');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Sql\Country');
    }
    public function properties()
    {
        return $this->hasMany('App\Models\Sql\Property');
    }
    public function membershipPlan()
    {
        return $this->belongsTo('App\Models\Sql\MembershipPlan');
    }
    public function document()
    {
        return $this->hasOne('App\Models\Sql\UserDocument');
    }
}
