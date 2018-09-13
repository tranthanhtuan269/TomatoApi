<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'price', 
        'image', 
        'service_id'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
