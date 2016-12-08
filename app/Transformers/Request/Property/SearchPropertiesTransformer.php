<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Property;


use App\Transformers\Request\RequestTransformer;


class SearchPropertiesTransformer extends RequestTransformer
{

    public function transform()
    {
        return [
            'wanted' => $this->request->get('wanted'),
            'purposeId' => $this->request->get('purpose_id'),
            'propertyTypeId' => $this->request->get('property_type_id'),
            'subTypeId' => $this->request->get('sub_type_id'),
            'societyId' => $this->request->get('society_id'),
            'cityId'=> $this->request->get('city_id'),
            'locationId'=> $this->request->get('location_id'),
            'blockId' => $this->request->get('block_id'),
            'bedrooms' => $this->request->get('bedrooms'),
            'priceFrom' => $this->request->get('price_from'),
            'priceTo' => $this->request->get('price_to'),
            'landUnitId' => $this->request->get('land_unit_id'),
            'landAreaFrom' => $this->request->get('land_area_from'),
            'landAreaTo' => $this->request->get('land_area_to'),
            'propertyFeatures' => $this->request->get('property_features'),
            'page' => $this->request->get('page'),
            'limit' => $this->request->get('limit'),
            'sortBy' => $this->request->get('sort_by'),
            'order' => $this->request->get('order')
        ];
    }
}