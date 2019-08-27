<?php

namespace App\Transformers;

use App\Group;
use League\Fractal\TransformerAbstract;
use App\Transformers\PackageTransformer;

class GroupTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['packages'];
    /* A Fractal transformer.
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

    public function includePackages(Group $group)
    {
        return $this->collection($group->packages, new PackageTransformer);
    }
}
