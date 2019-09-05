<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class CityTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['products'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image
        ];
    }

    public function includeProducts(City $city)
    {
        return $this->collection($city->products, new ProductTransformer);
    }
}
