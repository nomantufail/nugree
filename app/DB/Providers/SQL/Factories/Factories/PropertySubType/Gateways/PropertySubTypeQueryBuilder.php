<?php
namespace App\DB\Providers\SQL\Factories\Factories\PropertySubType\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertySubType\PropertySubTypeFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyType\PropertyTypeFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class PropertySubTypeQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'property_sub_types';
    }

    public function propertyCompleteType($propertyId)
    {
        $propertyTypes = (new PropertyTypeFactory())->getTable();
        $propertySubTypes = (new PropertySubTypeFactory())->getTable();
        $properties = (new PropertyFactory())->getTable();
        return  DB::table($properties)
            ->leftjoin($propertySubTypes,$properties.'.property_sub_type_id','=',$propertySubTypes.'.id')
            ->leftjoin($propertyTypes,$propertySubTypes.'.property_type_id','=',$propertyTypes.'.id')
            ->select(
                $propertyTypes.'.id as parentTypeId',$propertyTypes.'.type as parentTypeName',
                $propertySubTypes.'.id as subTypeId',$propertySubTypes.'.sub_type as subTypeName'
            )
            ->where($properties.'.id','=',$propertyId)
            ->first();
    }
}