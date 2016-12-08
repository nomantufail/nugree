<?php
namespace App\DB\Providers\SQL\Factories\Factories\News\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\NewsImages\NewsImagesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class NewsQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'news';
    }
    public function getRecentNews()
    {
        return DB::table($this->table)
            ->select($this->table.'.*')
            ->orderBy($this->table.'.id','DESC')
            ->get();
    }
    public function getAllNews($params =[])
    {
        $newsImageTable= (new NewsImagesFactory())->getTable();

       return DB::table($this->table)
            ->leftJoin($newsImageTable,$newsImageTable.'.news_id','=',$this->table.'.id')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS '.$this->table.'.*'.','.$newsImageTable.'.image'))
            ->skip($this->computePagination($params)['start'])->take(config('constants.defaultBannerLimit'))
            ->groupBy($this->table.'.id')
           ->orderBy($this->table.'.id','DESC')
            ->get();
    }
    public function newsCount()
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