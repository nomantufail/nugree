<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\PropertySubType;


use App\Transformers\Request\RequestTransformer;


class AssignFeatureTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'featureId'=>$this->request->input('feature_id'),
            'propertySubTypeId'=>$this->request->input('p_sub_type_id'),
        ];
    }
}