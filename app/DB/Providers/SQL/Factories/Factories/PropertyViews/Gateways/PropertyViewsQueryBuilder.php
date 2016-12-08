<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyViews\Gateways;

use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;

class PropertyViewsQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "property_views";
    }

    public function incrementViews($propertyIds)
    {
        $result = $this->setTable('properties')->incrementValuesWhereIn('id',$propertyIds,'total_views');
        $this->setTable('property_views');
        return $result;
    }
}