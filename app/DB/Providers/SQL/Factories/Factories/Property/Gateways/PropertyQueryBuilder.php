<?php
namespace App\DB\Providers\SQL\Factories\Factories\Property\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Block\BlockFactory;
use App\DB\Providers\SQL\Factories\Factories\City\CityFactory;
use App\DB\Providers\SQL\Factories\Factories\Country\CountryFactory;
use App\DB\Providers\SQL\Factories\Factories\Location\LocationFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyPurpose\PropertyPurposeFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertySubType\PropertySubTypeFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyType\PropertyTypeFactory;
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class PropertyQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'properties';
    }

    public function getCompleteLocation_deprecated ($propertyId)
    {
        $blocks = (new BlockFactory())->getTable();
        $societies = (new SocietyFactory())->getTable();
        $cities = (new CityFactory())->getTable();
        $countries = (new CountryFactory())->getTable();
        return  DB::table($this->table)
            ->leftjoin($blocks,$this->table.'.block_id','=',$blocks.'.id')
            ->leftjoin($societies,$blocks.'.society_id','=',$societies.'.id')
            ->leftjoin($cities,$societies.'.city_id','=',$cities.'.id')
            ->leftjoin($countries,$cities.'.country_id','=',$countries.'.id')
            ->select(
                $countries.'.id as countryId',$countries.'.country as countryName',
                $cities.'.id as cityId',$cities.'.city as cityName',
                $societies.'.id as societyId',$societies.'.society as societyName',
                $blocks.'.id as blockId',$blocks.'.block as blockName'
            )
            ->where($this->table.'.id','=',$propertyId)
            ->first();
    }

    public function getCompleteLocation($propertyId)
    {
        //$blocks = (new BlockFactory())->getTable();
        //$societies = (new SocietyFactory())->getTable();
        $location = (new LocationFactory())->getTable();
        $cities = (new CityFactory())->getTable();
        $countries = (new CountryFactory())->getTable();
        return  DB::table($this->table)
            ->leftjoin($location,$this->table.'.location_id','=',$location.'.id')
            ->leftjoin($cities,$location.'.city_id','=',$cities.'.id')
            ->leftjoin($countries,$cities.'.country_id','=',$countries.'.id')
            ->select(
                $countries.'.id as countryId',$countries.'.country as countryName',
                $cities.'.id as cityId',$cities.'.city as cityName',
                $location.'.id as locationId',$location.'.location as locationName'
                ,$location.'.city_id as cityId',$location.'.lat as lat',
                $location.'.long as long'
            )
            ->where($this->table.'.id','=',$propertyId)
            ->first();
    }

    public function countProperties($userId)
    {
        $propertyJsonTable = (new PropertyJsonFactory())->getTable();
        return DB::table($this->table)
            ->join($propertyJsonTable,$this->table.'.id','=',$propertyJsonTable.'.property_id')
            ->selectRaw('purpose_id, property_status_id, count('.$this->table.'.id) as totalPropertiesByStatus')
            ->where('owner_id','=',$userId)
            ->groupBy('purpose_id', 'property_status_id')
            ->get();
    }

    public function deleteByIds(array $propertyId)
    {
        $deleteStatusId = (new \PropertyStatusTableSeeder())->getDeletedStatusId();
        return DB::table($this->table)
            ->whereIn('id',$propertyId)
            ->update(['property_status_id'=>$deleteStatusId]);
    }
    public function forceDeleteByIds($propertyIds)
    {
        return DB::table($this->table)
            ->whereIn('id',$propertyIds)
            ->delete();
    }
    public function IncrementViews($propertyId)
    {
        return DB::table($this->table)
            ->where($this->table.'.id','=',$propertyId)
            ->increment('total_views', 1);
    }
    public function countSaleAndRendProperties()
    {
        $propertyPurpose = (new PropertyPurposeFactory())->getTable();
        return DB::table($this->table)
            ->leftjoin($propertyPurpose,$propertyPurpose.'.id','=',$this->table.'.purpose_id')
            ->select(DB::raw('count(*) as totalProperties, purpose_id as purposeId'),$propertyPurpose.'.display_name as displayName')
            ->groupBy($this->table.'.purpose_id')
            ->get();

    }

    public function userPropertiesState($userId)
    {
        $purposeTable = (new PropertyPurposeFactory())->getTable();
        $propertySubtypeTable = (new PropertySubTypeFactory())->getTable();

        return DB::table($this->table)
            ->leftjoin($purposeTable,$this->table.'.purpose_id','=',$purposeTable.'.id')
            ->leftjoin($propertySubtypeTable,$this->table.'.property_sub_type_id','=',$propertySubtypeTable.'.id')
            ->select(DB::raw('count('.$this->table.'.id) as  totalProperties, purpose_id as purposeId'),$purposeTable.'.display_name as purpose',$propertySubtypeTable.'.sub_type as subType')
            ->where($this->table.'.owner_id','=',$userId)
            ->groupBy($this->table.'.purpose_id')
            ->groupBy($this->table.'.property_sub_type_id')
            ->get();
    }
}