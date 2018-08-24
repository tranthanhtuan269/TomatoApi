<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 
        'display_name', 
        'email', 
        'phone_number', 
        'avatar', 
        'password', 
        'address', 
        'city_id', 
        'role_id', 
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups(){
        return $this->belongsToMany('App\Group');
    }
    
    public function checkInGroup($id){
        foreach ($this->groups()->get() as $group) {
            if($group->id == $id){
                return true;
            }
        }
        return false;
    }
}
