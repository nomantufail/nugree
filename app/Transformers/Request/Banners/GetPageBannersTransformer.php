<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Banners;


use App\Transformers\Request\RequestTransformer;


class GetPageBannersTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'pageId' => $this->request->get('page_id'),
            'page' => $this->request->get('page'),
            'limit' => $this->request->get('limit'),
        ];
    }
}