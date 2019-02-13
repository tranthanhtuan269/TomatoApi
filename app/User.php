<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'display_name', 
        'email', 
        'phone', 
        'avatar', 
        'password', 
        'address', 
        'city_id', 
        'role_id', 
        'active',
        'presenter_id',
        'order_number',
        'code',
        'coin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->belongsTo('App\Order');
    }
}
