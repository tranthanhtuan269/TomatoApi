<?php

namespace App\Transformers;

use App\Group;
use League\Fractal\TransformerAbstract;
use App\Transformers\JobTransformer;

class GroupTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['jobs'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Group $group)
    {
        return [
            'id' => $group->id,
            'name' => $group->name
        ];
    }

    public function includeJobs(Group $group)
    {
        return $this->collection($group->jobs, new JobTransformer);
    }
}
