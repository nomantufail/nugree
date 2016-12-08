<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\PropertyType;

use App\Transformers\Request\RequestTransformer;
class GetTypeBySubTypeTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'subTypeId'=>$this->request->input('sub_type_id')
        ];
    }
}