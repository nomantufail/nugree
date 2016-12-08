<?php
namespace App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FavouritePropertyQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'favourite_properties';
    }

        public function multiDeleteFavouriteProperty($propertyIds,$userId)
        {
           return  DB::table($this->table)
                ->whereIn($this->table.'.property_id',$propertyIds)
                ->where($this->table.'.user_id','=',$userId)
                ->delete();
        }
    public function isFavourite($propertyId,$userId)
    {
        return  DB::table($this->table)
            ->where($this->table.'.property_id',$propertyId)
            ->where($this->table.'.user_id','=',$userId)
            ->count();
    }
    public function getUserFavouritePropertiesIds($userId)
    {
        return  DB::table($this->table)
            ->select($this->table.'.property_id')
            ->where($this->table.'.user_id','=',$userId)
            ->get();
    }
}