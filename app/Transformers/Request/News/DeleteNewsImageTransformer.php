<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\News;


use App\Transformers\Request\RequestTransformer;


class DeleteNewsImageTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'imageId' => $this->request->get('image_id'),
        ];
    }
}