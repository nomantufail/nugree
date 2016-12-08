<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\PropertyType;


use App\Transformers\Request\RequestTransformer;


class AddPropertyTypeTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'propertyType'=>$this->request->input('p_type_name'),
        ];
    }
}