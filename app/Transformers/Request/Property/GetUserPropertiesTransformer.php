<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/3/2016
 * Time: 3:51 PM
 */

namespace App\Transformers\Request\Property;


use App\Transformers\Request\RequestTransformer;

class GetUserPropertiesTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'purposeId'=>$this->request->input('purpose_id'),
            'ownerId'=>$this->request->input('owner_id'),
            'statusId'=>$this->request->input('status_id'),
            'limit'=>$this->request->input('limit'),
            'start'=>$this->request->input('start'),
            'sortOn'=>$this->request->input('sort_on'),
            'sortBy'=>$this->request->input('sort_by'),
            'agencyId'=>$this->request->input('agency_id'),
            'propertyId'=>$this->request->input('property_id'),
        ];
    }
}