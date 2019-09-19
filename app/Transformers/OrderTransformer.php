<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\UserTransformer;
use App\Transformers\PackageTransformer;
use App\Order;

class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['group'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'address' => $order->address,
            'number_address' => $order->number_address,
            'note' => $order->note,
            'state' => $order->state,
            'user' => $order->user,
            'price' => ($order->price * (100 - $order->coupon_value) / 100) . '', 
            'pay_type' => $order->pay_type,
            'username' => $order->username,
            'email' => $order->email,
            'image' => $order->image,
            'promotion_code' => $order->promotion_code,
            'coupon_value' => $order->coupon_value,
            'list_products' => $order->list_products
        ];
    }

    public function includeUser(Order $order)
    {
        return $this->item($order->user, new UserTransformer);
    }

    public function includePackages(Order $order)
    {
        return $this->collection($order->packages, new PackageTransformer);
    }
}
