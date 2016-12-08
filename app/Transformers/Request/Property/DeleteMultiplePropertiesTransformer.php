<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Property;


use App\Transformers\Request\RequestTransformer;


class DeleteMultiplePropertiesTransformer extends RequestTransformer
{

    public function transform()
    {
       return [
           'propertyIds' => $this->request->input('propertyIds'),
           'searchParams' => $this->transformSearchParams(),
        ];
    }

    private function transformSearchParams()
    {
        $searchParams = $this->request->input('searchParams');
        return [
            'purposeId'=>(isset($searchParams['purpose_id']))?$searchParams['purpose_id']:null,
            'ownerId'=>(isset($searchParams['owner_id']))?$searchParams['owner_id']:null,
            'agencyId'=>(isset($searchParams['agency_id']))?$searchParams['agency_id']:null,
            'statusId'=>(isset($searchParams['status_id']))?$searchParams['status_id']:null,
            'limit'=>(isset($searchParams['limit']))?$searchParams['limit']:null,
            'start'=>(isset($searchParams['start']))?$searchParams['start']:null,
            'sortOn'=>(isset($searchParams['sort_on']))?$searchParams['sort_on']:null,
            'sortBy'=>(isset($searchParams['sort_by']))?$searchParams['sort_by']:null,
            'propertyId'=>(isset($searchParams['property_id']))?$searchParams['property_id']:null
        ];
    }
}