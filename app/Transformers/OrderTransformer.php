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
            'note' => $order->note,
            'start_time' => $order->start_time,
            'end_time' => $order->end_time,
            'state' => $order->state,
            'user' => $order->user,
            'price' => $order->price,
            'pay_type' => $order->pay_type,
            'package' => $order->packages
        ];
    }

    public function includeUser(Order $order)
    {
        return $this->item($job->user, new UserTransformer);
    }

    public function includePackages(Order $order)
    {
        return $this->item($job->packages, new PackageTransformer);
    }
}
