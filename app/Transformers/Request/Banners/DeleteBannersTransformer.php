<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Banners;


use App\Transformers\Request\RequestTransformer;


class DeleteBannersTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'bannerId' => $this->request->get('banner_id'),
        ];
    }
}