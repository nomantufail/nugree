<?php
namespace App\DB\Providers\SQL\Factories\Factories\Project\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\BannersPages\BannersPagesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSizes\BannersSizesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSocieties\BannersSocietiesFactory;
use App\DB\Providers\SQL\Factories\Factories\Pages\PagesFactory;
use App\DB\Providers\SQL\Factories\Factories\ProjectImages\ProjectImagesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\Libs\Helpers\LandArea;
use Illuminate\Support\Facades\DB;
class ProjectsQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'projects';
    }
    public function getAllProjects($params =[])
    {
        $projectImageTable= (new ProjectImagesFactory())->getTable();

       return DB::table($this->table)
            ->leftJoin($projectImageTable,$projectImageTable.'.project_id','=',$this->table.'.id')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS '.$this->table.'.*'.','.$projectImageTable.'.image'))
            ->skip($this->computePagination($params)['start'])->take(config('constants.defaultBannerLimit'))
            ->groupBy($this->table.'.id')
            ->orderBy($this->table.'.id','DESC')
            ->get();
    }
    public function projectCount()
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