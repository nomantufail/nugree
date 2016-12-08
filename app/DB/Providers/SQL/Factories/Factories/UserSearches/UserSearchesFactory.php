<?php

namespace App\DB\Providers\SQL\Factories\Factories\UserSearches;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\City\Gateways\CityQueryBuilder;
use App\DB\Providers\SQL\Factories\Factories\UserSearches\Gateways\UserSearchesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\UserSearches;

class UserSearchesFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new UserSearches();
        $this->tableGateway = new UserSearchesQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

   public function store($userSearches)
   {
        return $this->tableGateway->insert($this->mapUserSearchesOnTable($userSearches));
   }
    public function all()
    {
        return true;
    }
    private function mapUserSearchesOnTable(UserSearches $userSearches)
    {
        return [
            'purpose_id' => $userSearches->purposeId,
            'type_id'=>$userSearches->typeId,
            'property_sub_type_id'=>$userSearches->subTypeId,
            'country_id'=>$userSearches->countryId,
            'city_id'=>$userSearches->cityId,
            'location_id'=>$userSearches->locationId,
            'land_unit_id'=>$userSearches->landUnitId,
            'land_area_from'=>$userSearches->landAreaFrom,
            'land_area_to'=>$userSearches->landAreaTo,
            'price_from'=>$userSearches->priceFrom,
            'price_to'=>$userSearches->priceTo,
            'email'=>$userSearches->email,
            'mobile'=>$userSearches->mobile,
            'created_at' => $userSearches->createdAt,
        ];
    }

    function map($result)
    {
        $userSearches            = new UserSearches();
        $userSearches->id        = $result->id;
        $userSearches->purposeId        = $result->purpose_id;
        $userSearches->typeId        = $result->type_id;
        $userSearches->subTypeId        = $result->property_sub_type_id;
        $userSearches->countryId        = $result->country_id;
        $userSearches->cityId        = $result->city_id;
        $userSearches->locationId        = $result->location_id;
        $userSearches->landUnitId        = $result->land_unit_id;
        $userSearches->landAreaFrom        = $result->land_area_from;
        $userSearches->landAreaTo        = $result->land_area_to;
        $userSearches->priceFrom        = $result->price_from;
        $userSearches->priceTo        = $result->price_to;
        $userSearches->email        = $result->email;
        $userSearches->mobile        = $result->mobile;

        $userSearches->createdAt = $result->created_at;
        $userSearches->updatedAt = $result->updated_at;
        return $userSearches;
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
}