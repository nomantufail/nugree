<?php

namespace App\DB\Providers\SQL\Factories\Factories\FavouriteProperty;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\City\Gateways\CityQueryBuilder;
use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\Gateways\FavouritePropertyQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\FavouriteProperty;

class FavouritePropertyFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->tableGateway = new FavouritePropertyQueryBuilder();
    }
    public function deleteFavouriteProperty($params)
    {
        return  $this->tableGateway->deleteWhere(['property_id'=>$params['propertyId'],'user_id'=>$params['userId']]);
    }
    public function multiDeleteFavouriteProperty($propertyIds,$userId)
    {
       return $this->tableGateway->multiDeleteFavouriteProperty($propertyIds,$userId);
    }
    public function isFavourite($propertyId,$userId)
    {
        return $this->tableGateway->isFavourite($propertyId,$userId);
    }
    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    public function getUserFavouritePropertiesIds($userId)
    {
        return $this->tableGateway->getUserFavouritePropertiesIds($userId);
    }

    public function store(FavouriteProperty $favouriteProperty)
    {
        $favouriteProperty->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapFavouritePropertyOnTable($favouriteProperty));
    }

    private function mapFavouritePropertyOnTable(FavouriteProperty $favouriteProperty)
    {
        return [
            'property_id' => $favouriteProperty->propertyId,
            'user_id'=>$favouriteProperty->userId,
            'updated_at' => $favouriteProperty->updatedAt,
        ];
    }

    function map($result)
    {
        $favourite  = new FavouriteProperty();
        $favourite->id = $result->id;
        $favourite->propertyId = $result->property_id;
        $favourite->userId= $result->user_id;
        $favourite->createdAt = $result->created_at;
        $favourite->updatedAt = $result->updated_at;
        return $favourite;
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