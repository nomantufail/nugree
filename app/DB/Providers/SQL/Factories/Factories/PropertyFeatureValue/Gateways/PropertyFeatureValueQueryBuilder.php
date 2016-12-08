<?php

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\PropertyFeatureValue\Gateways;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class PropertyFeatureValueQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'property_feature_values';
    }

    public function getBySubType($subTypeId)
    {
        $propertySubTypeAssignedFeatures = 'property_sub_type_assigned_features';
        return  DB::table($propertySubTypeAssignedFeatures)
            ->leftjoin($this->table,$propertySubTypeAssignedFeatures.'.property_feature_id','=',$this->table.'.id')
            ->select($this->table.'.*')
            ->where($propertySubTypeAssignedFeatures.'.id','=',$subTypeId)
            ->get();
    }
}