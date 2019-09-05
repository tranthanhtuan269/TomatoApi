<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;
use App\Transformers\CityTransformer;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['city'];
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

    public function includeCity(Product $product)
    {
        return $this->item($product->city, new CityTransformer);
    }
}
