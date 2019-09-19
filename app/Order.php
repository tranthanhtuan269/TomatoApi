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
        'number_address',
        'note',
        'state',
        'price',
        'real_price',
        'pay_type',
        'username',
        'email',
        'status_payment',
        'promotion_code',
        'coupon_value',
        'image',
        'list_products'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('number');
    }
}
