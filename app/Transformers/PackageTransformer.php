<?php

namespace App\Transformers;

use App\Package;
use League\Fractal\TransformerAbstract;
use App\Transformers\ServiceTransformer;

class PackageTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['service'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Package $package)
    {
        return [
            'id' => $package->id,
            'details' => $package->details,
            'service' => $package->service
        ];
    }

    public function includeService(Package $package)
    {
        return $this->item($package->service, new ServiceTransformer);
    }
}
