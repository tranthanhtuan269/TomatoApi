<?php

namespace App\Transformers;

use App\Service;
use League\Fractal\TransformerAbstract;
use App\Transformers\PackageTransformer;

class ServiceTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['packages', 'services'];
    /* A Fractal transformer.
     *
     * @return array
     */
    public function transform(Service $service)
    {
        return [
            'id' => $service->id,
            'name' => $service->name,
            'icon' => $service->icon,
            'index' => $service->index,
            'services' => $service->services,
            'packages' => $service->packages
        ];
    }

    public function includePackages(Service $service)
    {
        return $this->collection($service->packages, new PackageTransformer);
    }

    public function includeServices(Service $service)
    {
        return $this->collection($service->services, new ServiceTransformer);
    }
}
