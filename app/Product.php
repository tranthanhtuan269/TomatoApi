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
        'category_id',
        'address',
        'active'
    ];
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
