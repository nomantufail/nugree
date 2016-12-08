<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Feature;


use App\Transformers\Request\RequestTransformer;


class GetPropertySubTypeAssignedFeaturesTransformer extends RequestTransformer
{
    public function transform()
    {
        return $this->request->all();
    }
}