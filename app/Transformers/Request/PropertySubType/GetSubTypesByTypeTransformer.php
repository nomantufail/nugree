<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\PropertySubType;


use App\Transformers\Request\RequestTransformer;


class GetSubTypesByTypeTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'typeId'=>$this->request->input('type_id')
        ];
    }
}