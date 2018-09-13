<?php

namespace App\Transformers;

use App\Job;
use League\Fractal\TransformerAbstract;
use App\Transformers\UserTransformer;
use App\Transformers\PackageTransformer;

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
            'stop_time' => $order->stop_time,
            'state' => $order->state,
            'user' => $order->user,
            'price' => $order->price,
            'pay_type' => $order->pay_type,
            'package' => $order->package
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
