<?php
namespace App\DB\Providers\SQL\Factories\Factories\PropertyType\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\PropertySubType\PropertySubTypeFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class PropertyTypeQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'property_types';
    }

    public function getBySubType($subTypeId)
    {
        $subTypeFactory = new PropertySubTypeFactory();
        $subTypeTable = $subTypeFactory->getTable();
        return  DB::table($subTypeTable)
                ->leftjoin($this->table,$subTypeTable.'.property_type_id','=',$this->table.'.id')
                ->select($this->table.'.*')
                ->where($subTypeTable.'.id','=',$subTypeId)
                ->first();
    }

    public function getSortedPropertyTypes()
    {
        return DB::table($this->table)
            ->orderBy($this->table.'.priority','asc')
            ->get();
    }
}