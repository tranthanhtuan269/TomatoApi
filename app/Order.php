<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
        'note',
        'start_time',
        'end_time',
        'state',
        'price',
        'pay_type',
        'username',
        'email',
        'promotion_code',
        'list_packages'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the post that owns the comment.
     */
    public function packages()
    {
        return $this->belongsToMany('App\Package');
    }
}
