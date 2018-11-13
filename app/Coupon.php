<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'service_id', 
        'value', 
        'expiration_date'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
