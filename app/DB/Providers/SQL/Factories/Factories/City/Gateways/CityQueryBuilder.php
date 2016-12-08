<?php
namespace App\DB\Providers\SQL\Factories\Factories\City\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Location\LocationFactory;
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class CityQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'cities';
    }

    public function getBySociety($societyId)
    {
        $societyFactory = new SocietyFactory();
        $societyTable = $societyFactory->getTable();
        return  DB::table($societyTable)
                ->leftjoin($this->table,$societyTable.'.city_id','=',$this->table.'.id')
                ->select($this->table.'.*')
                ->where($societyTable.'.id','=',$societyId)
                ->first();
    }
    public function getImportantCities()
    {
        return  DB::table($this->table)
            ->select($this->table.'.*')
            ->where($this->table.'.priority','>',0)
            ->orderBy($this->table.'.priority', 'DESC')
            ->get();
    }

    public function getAllCities($params =[])
    {
        return DB::table($this->table)
            ->select(DB::raw('SQL_CALC_FOUND_ROWS '.$this->table.'.*'))
            ->skip($this->computePagination($params)['start'])->take(config('constants.defaultBannerLimit'))
            ->groupBy($this->table.'.id')
            ->orderBy($this->table.'.priority','DESC')
            ->get();
    }
    public function citesCount()
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