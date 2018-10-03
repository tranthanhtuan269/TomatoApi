<?php

namespace App\Transformers;

use App\Service;
use League\Fractal\TransformerAbstract;
use App\Transformers\PackageTransformer;

class ServiceTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['packages'];
    /* A Fractal transformer.
     *
     * @return array
     */
    public function transform(Service $service)
    {
        return [
            'id' => $service->id,
            'name' => $service->name,
            'icon' => $service->icon
        ];
    }

    public function includePackages(Service $service)
    {
        return $this->collection($service->packages, new PackageTransformer);
    }
}
