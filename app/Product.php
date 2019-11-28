<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'price',
        'sale',
        'category_id',
        'address',
        'unit',
        'active'
    ];
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function partner(){
        return $this->belongsTo('App\Partner');
    }
}
