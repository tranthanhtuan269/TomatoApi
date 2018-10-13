<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\News;

class NewsTransformer extends TransformerAbstract
{
    /* A Fractal transformer.
     *
     * @return array
     */
    public function transform(News $news)
    {
        return [
            'id' => $news->id,
            'title' => $news->title,
            'content' => $news->content,
            'author' => $news->author,
            'created_at' => $news->created_at->format('d-m-y'),
            'updated_at' => $news->updated_at->format('d-m-y')
        ];
    }
}
