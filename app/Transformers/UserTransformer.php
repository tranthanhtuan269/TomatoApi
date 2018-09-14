<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\OrderTransformer;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['orders'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'display_name' => $user->display_name,
            'avatar' => $user->avatar,
            'email' => $user->email,
            'phone' => $user->phone,
            'code' => $user->code,
            'role_id' => $user->role_id
        ];
    }

    public function includeOrders(User $user)
    {
        return $this->collection($user->orders, new OrderTransformer);
    }
}
