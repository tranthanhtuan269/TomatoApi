<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;
use App\Transformers\CategoryTransformer;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['category'];
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
            'sale' => $product->sale,
            'unit' => $product->unit,
            'image' => url('/').'/images/'.$product->image,
            'address' => $product->address,
        ];
    }

    public function includeCategory(Product $product)
    {
        return $this->item($product->category, new CategoryTransformer);
    }
}
