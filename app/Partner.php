<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
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
        'email',
        'phone',
        'active'
    ];

    /**
     * The roles that belong to the user.
     */
    public function services()
    {
        return $this->belongsToMany('App\Service', 'partner_service', 'partner_id', 'service_id');
    }
}
