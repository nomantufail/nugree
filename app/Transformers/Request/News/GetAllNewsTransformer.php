<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\News;


use App\Transformers\Request\RequestTransformer;


class GetAllNewsTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'page' => $this->request->get('page'),
            'limit' => $this->request->get('limit'),
        ];
    }
}