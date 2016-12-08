<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\PropertyStatus;


use App\Transformers\Request\RequestTransformer;


class AddPropertyStatusTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'propertyStatus'=>$this->request->input('property_status_name'),

        ];
    }
}