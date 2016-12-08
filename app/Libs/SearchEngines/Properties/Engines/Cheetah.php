<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 6/9/2016
 * Time: 5:59 AM
 */

namespace App\Libs\SearchEngines\Properties\Engines;


use App\DB\Providers\SQL\Factories\Factories\Block\BlockFactory;
use App\DB\Providers\SQL\Factories\Factories\Location\LocationFactory;
use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyFeatureValue\PropertyFeatureValueFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertySubType\PropertySubTypeFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyType\PropertyTypeFactory;
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\Libs\Helpers\LandArea;
use App\Libs\SearchEngines\Properties\PropertiesSearchEngineInterface;
use Illuminate\Support\Facades\DB;

class Cheetah extends PropertiesSearchEngine implements PropertiesSearchEngineInterface
{
    private $instructions = [];

    public function go()
    {
        $properties = $this->buildQuery()->get();
        return $properties;
    }

    public function count()
    {
        return (DB::select('select FOUND_ROWS() as total_records'));
    }

    public function setInstructions(array $instructions)
    {
        $this->instructions = $instructions;
        return $this;
    }

    private function buildQuery()
    {
        $propertyStatusSeeder = new \PropertyStatusTableSeeder();
        $properties = (new PropertyFactory())->getTable();
        $propertyTypes = (new PropertyTypeFactory())->getTable();
        $propertySubTypes = (new PropertySubTypeFactory())->getTable();
        //$societies = (new SocietyFactory())->getTable();
        //$blocks = (new BlockFactory())->getTable();
        $location = (new LocationFactory())->getTable();
        $propertyJsonTable = (new PropertyJsonFactory())->getTable();
        $propertyFeatureValues = (new PropertyFeatureValueFactory())->getTable();

        $query = DB::table($properties)
            ->join($propertyJsonTable,$properties.'.id','=',$propertyJsonTable.'.property_id')
            ->leftjoin($propertySubTypes,$properties.'.property_sub_type_id','=',$propertySubTypes.'.id')
            ->leftjoin($location,$properties.'.location_id','=',$location.'.id')
            ->leftjoin($propertyFeatureValues,$properties.'.id','=',$propertyFeatureValues.'.property_id')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS '.$propertyJsonTable.'.json'));

//        if(isset($this->instructions['neededProperties']) && $this->instructions['neededProperties'] != null && $this->instructions['neededProperties'] != '')
//            $query = $query->where($properties.'.wanted',$this->instructions['neededProperties']);

//        if($this->instructions['purposeId'] == 3) {
//            $query = $query->where($properties . '.wanted', 1);
//        }
//        else
//        {
//            $query = $query->where($properties . '.wanted', 0);
//            if(isset($this->instructions['purposeId']) && $this->instructions['purposeId'] != null && $this->instructions['purposeId'] != '')
//                $query = $query->where($properties.'.purpose_id',$this->instructions['purposeId']);
//        }
        if(isset($this->instructions['wanted']) && $this->instructions['wanted'] != null && $this->instructions['wanted'] != '')
            $query = $query->where($properties .'.wanted',$this->instructions['wanted']);
        if(isset($this->instructions['purposeId']) && $this->instructions['purposeId'] != null && $this->instructions['purposeId'] != '')
            $query = $query->where($properties.'.purpose_id',$this->instructions['purposeId']);
        if(isset($this->instructions['propertyTypeId']) && $this->instructions['propertyTypeId'] != null && $this->instructions['propertyTypeId'] != '')
            $query = $query->where($propertySubTypes.'.property_type_id',$this->instructions['propertyTypeId']);
        if(isset($this->instructions['subTypeId']) && $this->instructions['subTypeId'] != null && $this->instructions['subTypeId'] != '')
            $query = $query->where($properties.'.property_sub_type_id',$this->instructions['subTypeId']);
        if(isset($this->instructions['cityId']) && $this->instructions['cityId'] != null && $this->instructions['cityId'] != '')
            $query = $query->where($location.'.city_id',$this->instructions['cityId']);

        if(isset($this->instructions['locationId']) && $this->instructions['locationId'] != null && $this->instructions['locationId'] != '')
            $query = $query->whereIn($properties.'.location_id',$this->instructions['locationId']);

        if(isset($this->instructions['priceFrom']) && $this->instructions['priceFrom'] != null && $this->instructions['priceFrom'] != '')
            $query = $query->where($properties.'.price','>=',$this->instructions['priceFrom']);
        if(isset($this->instructions['priceTo']) && $this->instructions['priceTo'] != null && $this->instructions['priceTo'] != '')
            $query = $query->where($properties.'.price', '<=', $this->instructions['priceTo']);
        if(isset($this->instructions['landAreaFrom']) && $this->instructions['landAreaFrom'] != null && $this->instructions['landAreaFrom'] != '')
            if(isset($this->instructions['landUnitId']) && $this->instructions['landUnitId'] != null && $this->instructions['landUnitId'] != '')
                $query = $query->where($properties.'.land_area', '>=', LandArea::convert(config('constants.LAND_UNITS')[$this->instructions['landUnitId']], 'square feet',$this->instructions['landAreaFrom']));
        if(isset($this->instructions['landAreaTo']) && $this->instructions['landAreaTo'] != null && $this->instructions['landAreaTo'] != '')
            if(isset($this->instructions['landUnitId']) && $this->instructions['landUnitId'] != null && $this->instructions['landUnitId'] != '')
                $query = $query->where($properties.'.land_area', '<=', LandArea::convert(config('constants.LAND_UNITS')[$this->instructions['landUnitId']], 'square feet',$this->instructions['landAreaTo']));
        if(isset($this->instructions['ownerIds']) && $this->instructions['ownerIds'] != null && $this->instructions['ownerIds'] != '')
            $query = $query->whereIn($properties.'.owner_id', $this->instructions['ownerIds']);

        if(isset($this->instructions['propertyFeatures']) && $this->instructions['propertyFeatures'] != null && is_array($this->instructions['propertyFeatures']))
        {
            foreach($this->instructions['propertyFeatures'] as $key => $value){
                if($value != '' && $value != null){
                    $query = $query->where([
                        $propertyFeatureValues.'.property_feature_id' => $key,
                        $propertyFeatureValues.'.value' => $value
                    ]);
                }
            }
        }

        /* static conditions by system policies */
        $query = $query->where($properties.'.property_status_id', $propertyStatusSeeder->getActiveStatusId());
        /*--------------------------------------*/

        $sorting = $this->computeSorting();
        $query = $query->orderBy($sorting['sortBy'],$sorting['order']);
        $query = $query->skip($this->computePagination()['start'])->take($this->computePagination()['limit']);
        $query = $query->distinct();
        return $query;
    }

    private function computeSorting()
    {
        return [
            'sortBy' => $this->getSortableColumnValue(isset($this->instructions['sortBy'])?$this->instructions['sortBy']:$this->defaultSorting()['sortBy']),
            'order' => $this->getOrder()
        ];
    }

    private function computePagination()
    {
        $pagination = [
            'start' => 0,
            'limit' => config('constants.PROPERTIES_LIMIT')
        ];
        if(isset($this->instructions['page']) ){
            $page = intval($this->instructions['page']);
            $page = ($page < 1)?1: $page;
            $limit = intval($this->instructions['limit']);
            $limit = ($limit < 1)?config('constants.PROPERTIES_LIMIT'):$limit;
            $start = $limit*($page-1);

            $pagination['start'] = $start;
            $pagination['limit'] = $limit;
        }
        return $pagination;
    }

    private function defaultSorting()
    {
        return [
            'sortBy' => 'properties.id',
            'order' => 'desc'
        ];
    }

    private function getSortableColumns()
    {
        return [
            'id' => 'properties.id',
            'type' => 'property_types.type',
            'price'=> 'properties.price',
            'land'=>'properties.land_area',
            'date'=>'properties.created_at',
            'verified'=>'properties.is_verified',
            'updated_at' => 'properties.updated_at',
        ];
    }

    private function getSortableColumnValue($column)
    {
        if(isset($this->getSortableColumns()[$column]))
        {
           return $this->getSortableColumns()[$column];
        }
        return $this->defaultSorting()['sortBy'];
    }

    private function getOrder()
    {
        if(isset($this->instructions['order']) && ($this->instructions['order'] == 'desc' || $this->instructions['order'] == 'asc'))
        {
            return $this->instructions['order'];
        }
        return 'desc';
    }

}