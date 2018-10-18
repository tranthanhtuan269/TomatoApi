<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'content'
    ];
}
