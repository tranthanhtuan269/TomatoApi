<?php

namespace App\Transformers;

use App\Transformers\CityTransformer;
use App\Transformers\ProductTransformer;
use League\Fractal\TransformerAbstract;
use App\Category;

class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['city', 'products'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'city' => $category->city,
            'products' => $category->products
        ];
    }

    public function includeCity(Category $category)
    {
        return $this->item($category->city, new CityTransformer);
    }

    public function includeProducts(Category $category)
    {
        return $this->item($category->products, new ProductTransformer);
    }
}
