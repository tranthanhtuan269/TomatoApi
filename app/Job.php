<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'note', 'start_time', 'end_time', 'user_id', 'state'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
     * The roles that belong to the user.
     */
    public function packages()
    {
        return $this->belongsToMany('App\Package');
    }
}
