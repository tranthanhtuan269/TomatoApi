<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\GroupTransformer;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['group'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'user_id' => $user->id,
            'user_name' => $user->user_name,
            'display_name' => $user->display_name,
            'avatar' => $user->avatar,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'role_id' => $user->role_id
        ];
    }

    public function includeGroup(User $user)
    {
        return $this->collection($user->group, new GroupTransformer);
    }
}
