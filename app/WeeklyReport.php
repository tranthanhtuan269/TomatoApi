<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeklyReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'weekly_report';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'number', 
        'total', 
        'rewards', 
        'promotional'
    ];
}
