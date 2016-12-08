<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\PropertySubType;


use App\Transformers\Request\RequestTransformer;


class UpdatePropertySubTypeTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id' =>$this->request->input('p_sub_type_id'),
            'propertySubTypeName'=>$this->request->input('p_sub_type_name'),
            'propertyTypeId'=>$this->request->input('p_type_id'),
        ];
    }
}