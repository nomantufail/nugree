<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\AppResources;


use App\Transformers\Request\RequestTransformer;


class GetDashboardResourcesTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'userId'=>$this->request->input('user_id'),
        ];
    }
}