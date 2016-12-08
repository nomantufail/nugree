<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways;


use App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\AgencyStaffFactory;
use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways\Helpers\UserPropertiesHelper;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\DB\Providers\SQL\Factories\Factories\User\UserFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\Libs\SearchEngines\Properties\Engines\Cheetah;
use Illuminate\Support\Facades\DB;

class PropertyJsonQueryBuilder extends QueryBuilder{
    use UserPropertiesHelper;

    public function __construct(){
        $this->table = "property_json";
    }
    public function findByProperty($id)
    {
        return DB::table($this->table)->where('property_id','=',$id)->first();
    }

    public function search(array $params)
    {
        return (new Cheetah())->setInstructions($params)->go();
    }

    public function getUserProperties($params)
    {
        $conditions =$this->computeUserPropertiesParams($params);
        $limit = $this->getLimit($params);
        $sort = $this->sortBy($params);
        $table = (new PropertyFactory())->getTable();
        $propertyJsonTable = (new PropertyJsonFactory())->getTable();
        $userTable = (new UserFactory())->getTable();
        $agencyStaff = (new AgencyStaffFactory())->getTable();
        $agencyTable = (new AgencyFactory())->getTable();

        return DB::table($table)
            ->join($propertyJsonTable,$table.'.id','=',$propertyJsonTable.'.property_id')
            ->leftjoin($userTable,$table.'.owner_id','=',$userTable.'.id')
            ->leftjoin($agencyStaff,$userTable.'.id','=',$agencyStaff.'.user_id')
            ->leftjoin($agencyTable,$agencyStaff.'.agency_id','=',$agencyTable.'.id')
            ->select($propertyJsonTable.'.json')
            ->where($conditions)
            ->orderBy($table.'.'.$sort['sortOn'],$sort['sortBy'])
            ->skip($limit['start'])->take($limit['limit'])
            ->distinct()
            ->get();
    }
    public function findBySlug($slug)
    {
        $propertyTable = (new PropertyFactory())->getTable();
        $propertyJsonTable = (new PropertyJsonFactory())->getTable();

        return DB::table($propertyTable)
            ->join($propertyJsonTable,$propertyTable.'.id','=',$propertyJsonTable.'.property_id')
            ->select($propertyJsonTable.'.json')
            ->where($propertyTable.".slug",$slug)
            ->first();
    }

    public function countSearchedUserProperties($params)
    {
        $conditions =$this->computeUserPropertiesParams($params);
        $table = (new PropertyFactory())->getTable();
        $propertyJsonTable = (new PropertyJsonFactory())->getTable();
        $userTable = (new UserFactory())->getTable();
        $agencyStaff = (new AgencyStaffFactory())->getTable();
        $agencyTable = (new AgencyFactory())->getTable();
         return DB::table($table)
             ->join($propertyJsonTable,$table.'.id','=',$propertyJsonTable.'.property_id')
             ->leftjoin($userTable,$table.'.owner_id','=',$userTable.'.id')
             ->leftjoin($agencyStaff,$userTable.'.id','=',$agencyStaff.'.user_id')
             ->leftjoin($agencyTable,$agencyStaff.'.agency_id','=',$agencyTable.'.id')
             ->select($this->table.'.json')
             ->where($conditions)
             ->distinct()
             ->count();
    }

    public function getFavouriteProperties($params)
    {
        $propertyTable = (new PropertyFactory())->getTable();
        $userTable = (new UserFactory())->getTable();
        $limit = $this->getFavouritePropertyLimit($params);
        $favouritePropertyTable = (new FavouritePropertyFactory())->getTable();
        return DB::table($userTable)
            ->leftjoin($favouritePropertyTable,$userTable.'.id','=',$favouritePropertyTable.'.user_id')
            ->leftjoin($propertyTable,$propertyTable.'.id','=',$favouritePropertyTable.'.property_id')
            ->join($this->table,$propertyTable.'.id','=',$this->table.'.property_id')
            ->select($this->table.'.json')
            ->where($userTable.'.id','=',$params['userId'])
            ->skip($limit['start'])->take($limit['limit'])
            ->get();
    }

    public function countFavouriteProperties($userId)
    {
        $propertyTable = (new PropertyFactory())->getTable();
        $userTable = (new UserFactory())->getTable();
        $favouritePropertyTable = (new FavouritePropertyFactory())->getTable();
        return DB::table($userTable)
            ->leftjoin($favouritePropertyTable,$userTable.'.id','=',$favouritePropertyTable.'.user_id')
            ->leftjoin($propertyTable,$propertyTable.'.id','=',$favouritePropertyTable.'.property_id')
            ->join($this->table,$propertyTable.'.id','=',$this->table.'.property_id')
            ->select($this->table.'.json')
            ->where($userTable.'.id','=',$userId)
            ->count();
    }

    public function getAgencyProperties($agencyId)
    {
        $propertyTable = (new PropertyFactory())->getTable();
        $agencyTable = (new AgencyFactory())->getTable();
        $agencyStaff = (new AgencyStaffFactory())->getTable();
        return DB::table($agencyTable)
            ->leftjoin($agencyStaff,$agencyStaff.'.agency_id','=',$agencyTable.'.id')
            ->leftjoin($propertyTable,$propertyTable.'.owner_id','=',$agencyStaff.'.user_id')
            ->join($this->table,$propertyTable.'.id','=',$this->table.'.property_id')
            ->select($this->table.'.json')
            ->where($agencyTable.'.id','=',$agencyId)
            ->get();
    }

    public function getPropertiesByStatuses($propertyStatus)
    {
        $propertyTable = (new PropertyFactory())->getTable();
        return DB::table($propertyTable)
            ->join($this->table,$propertyTable.'.id','=',$this->table.'.property_id')
            ->select($this->table.'.json')
            ->where($propertyTable.'.property_status_id','=',$propertyStatus)
            ->get();
    }
}