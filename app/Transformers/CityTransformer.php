<?php

namespace App\Transformers;

use App\City;
use League\Fractal\TransformerAbstract;
use App\Transformers\CategoryTransformer;

class CityTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['categories'];
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
            'image' => url('/').'/public/images/'.$city->image
        ];
    }

    public function includeCategories(City $city)
    {
        return $this->collection($city->categories, new CategoryTransformer);
    }
}
