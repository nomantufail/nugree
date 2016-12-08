<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\News;


use App\Transformers\Request\RequestTransformer;


class GetNewsImagesTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'newsId' => $this->request->get('news_id'),
        ];
    }
}