<?php

namespace App\Transformers;

use App\City;
use League\Fractal\TransformerAbstract;

class CityTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['products'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(City $city)
    {
        return [
            'id' => $city->id,
            'name' => $city->name,
            'image' => $city->image
        ];
    }

    public function includeProducts(City $city)
    {
        return $this->collection($city->products, new ProductTransformer);
    }
}
