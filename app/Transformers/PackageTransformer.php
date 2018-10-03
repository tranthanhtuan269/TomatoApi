<?php

namespace App\Transformers;

use App\Package;
use League\Fractal\TransformerAbstract;
use App\Transformers\GroupTransformer;
use App\Transformers\ServiceTransformer;

class PackageTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['service', 'group'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Package $package)
    {
        return [
            'id' => $package->id,
            'name' => $package->name,
            'price' => $package->price,
            'image' => $package->image
        ];
    }

    public function includeService(Package $package)
    {
        return $this->item($package->service, new ServiceTransformer);
    }

    public function includeGroup(Package $package)
    {
        return $this->item($package->group, new GroupTransformer);
    }
}
