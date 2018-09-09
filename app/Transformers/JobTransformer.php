<?php

namespace App\Transformers;

use App\Job;
use League\Fractal\TransformerAbstract;
use App\Transformers\GroupTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\PackageTransformer;

class JobTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['group', 'user', 'package'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Job $job)
    {
        return [
            'id' => $job->id,
            'address' => $job->address,
            'note' => $job->note,
            'start_time' => $job->start_time,
            'state' => $job->state,
            'user' => $job->user,
            'package' => $job->packages
        ];
    }

    public function includeGroup(Job $job)
    {
        return $this->item($job->group, new GroupTransformer);
    }

    public function includeUser(Job $job)
    {
        return $this->item($job->user, new UserTransformer);
    }

    public function includePackage(Job $job)
    {
        return $this->item($job->packages, new PackageTransformer);
    }
}
