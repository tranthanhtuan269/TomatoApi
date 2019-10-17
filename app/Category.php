<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'city_id'
    ];
    
    public function city(){
        return $this->belongsTo('App\City');
    }

    public function products(){
        return $this->hasMany('App\Product')->where('active', 1);
    }
}
