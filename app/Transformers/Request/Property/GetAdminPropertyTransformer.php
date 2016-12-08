<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Property;


use App\Transformers\Request\RequestTransformer;


class GetAdminPropertyTransformer extends RequestTransformer
{

    public function transform()
    {
       return [
           'propertyId' => $this->request->input('propertyId'),
        ];
    }


}