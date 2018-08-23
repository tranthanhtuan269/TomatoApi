<?php

namespace App\Transformers;

use App\Group;
use League\Fractal\TransformerAbstract;
use App\Transformers\UserTransformer;

class GroupTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['users'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Group $group)
    {
        return [
            'id' => $group->id,
            'group_name' => $group->group_name
        ];
    }

    public function includeUsers(Group $group)
    {
        return $this->collection($group->users, new UserTransformer);
    }
}
