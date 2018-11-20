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
        'start_time',
        'end_time',
        'state',
        'price',
        'real_price',
        'pay_type',
        'username',
        'email',
        'promotion_code',
        'coupon_value',
        'image',
        'list_packages',
        'service_id'
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
        return $this->belongsToMany('App\Package')->withPivot('number');
    }

    public static function getServiceInfo($id)
    {
        $order = Order::find($id);

        if(isset($order)){
            $object = $order->packages()->first();
            if(isset($object)){
                return Service::getServiceParent($object->service_id);    
            }
        }

        return Service::find(1);
    }
}
