<?php
namespace App\DB\Providers\SQL\Factories\Factories\Location\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\AgencyLocation\AgencyLocationFactory;
use App\DB\Providers\SQL\Factories\Factories\City\CityFactory;
use App\DB\Providers\SQL\Factories\Factories\Location\LocationFactory;
use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class LocationQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'locations';
    }
    public function search($params)
    {
        $query = DB::table($this->table)
            ->select($this->table.'.*');
        if($params['cityId'] != null && $params['cityId'] != "" && $params['cityId'] != 0)
            $query = $query->where($this->table.'.city_id','=',$params['cityId']);
        return $query->where($this->table.'.location','like','%'.$params['keyword'].'%')->get();
    }
    public function getLocationByCity($params)
    {
        return DB::table($this->table)
            ->select($this->table.'.*')
            ->where($this->table.'.city_id','=',$params['cityId'])
            ->get();
    }
    public function getByCity($params)
    {
        $property = (new PropertyFactory())->getTable();
        return DB::table($property)
            ->rightjoin($this->table,$this->table.'.id','=',$property.'.location_id')
            ->select((DB::raw('count('.$property.'.id) as totalProperties')),$this->table.'.*')
            ->where($this->table.'.city_id','=',$params['cityId'])
            ->groupBy($this->table.'.id')
            ->havingRaw('count('.$property.'.id) > 0')
            ->get();
    }
    public function getCityLocationCount($cityId)
    {
        $cityTable = (new CityFactory())->getTable();
        $property = (new PropertyFactory())->getTable();
        return DB::table($cityTable)
            ->rightjoin($this->table,$this->table.'.city_id','=',$cityTable.'.id')
            ->leftjoin($property,$this->table.'.id','=',$property.'.location_id')
            ->select((DB::raw('count('.$property.'.id) as totalLocations')),$cityTable.'.city as cityName', $cityTable.'.slug as citySlug')
            ->where($this->table.'.city_id','=',$cityId)
            ->groupBy($cityTable.'.id')
            ->get();
    }
    public function getLocationsByAgency($agencyId)
    {
        $agencyLocation = (new AgencyLocationFactory())->getTable();

        return DB::table($agencyLocation)
            ->leftjoin($this->table,$agencyLocation.'.location_id','=',$this->table.'.id')
            ->select($this->table.'.*')
            ->where($agencyLocation.'.agency_id','=',$agencyId)
            ->get();
    }
    public function locationCount()
    {
        return DB::select('select FOUND_ROWS() as total_records');
    }

    private function computePagination($params)
    {
        $pagination = [
            'start' => 0,
            'limit' => config('constants.PROPERTIES_LIMIT')
        ];
        if(isset($params['page']) ){
            $page = intval($params['page']);
            $page = ($page < 1)?1: $page;
            $limit = intval($params['limit']);
            $limit = ($limit < 1)?config('constants.defaultBannerLimit'):$limit;
            $start = $limit*($page-1);

            $pagination['start'] = $start;
            $pagination['limit'] = $limit;
        }
        return $pagination;
    }


}