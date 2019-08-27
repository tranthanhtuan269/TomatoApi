<?php

namespace App\Transformers;

use App\Service;
use League\Fractal\TransformerAbstract;
use App\Transformers\PackageTransformer;

class ServiceTransformerWeb extends TransformerAbstract
{
    protected $availableIncludes = ['services'];
    /* A Fractal transformer.
     *
     * @return array
     */
    public function transform(Service $service)
    {
        return [
            'id' => $service->id,
            'name' => $service->name,
            'name_en' => $service->name_en,
            'name_ja' => $service->name_ja,
            'name_ko' => $service->name_ko,
            'icon' => $service->icon
        ];
    }

    public function includeServices(Service $service)
    {
        return $this->collection($service->services, new ServiceTransformer);
    }
}
