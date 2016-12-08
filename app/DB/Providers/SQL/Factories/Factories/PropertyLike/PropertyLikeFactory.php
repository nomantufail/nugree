<?php

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\PropertyLike;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyLike\Gateways\PropertyLikeQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\DB\Providers\SQL\Models\Features\PropertyFeatureValue;
use App\DB\Providers\SQL\Models\FeatureSection;
use App\DB\Providers\SQL\Models\PropertyLike;

class PropertyLikeFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->tableGateway = new PropertyLikeQueryBuilder();
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    public function getBySubType($subTypeId)
    {
        return $this->mapCollection($this->tableGateway->getBySubType($subTypeId));
    }
    public function getById($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function update(PropertyLike $propertyLike)
    {
        $propertyLike->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($propertyLike->id ,$this->mapPropertyLikeValueOnTable($propertyLike));
    }

    public function store(PropertyLike $propertyLike)
    {
        $propertyLike->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyLikeValueOnTable($propertyLike));
    }
    public function getTotalLikes(PropertyLike $propertyLike)
    {
        return $this->tableGateway->count(['property_id'=>$propertyLike->propertyId]);
    }
    public function delete(PropertyLike $propertyLike)
    {
        return $this->tableGateway->delete($propertyLike->id);
    }

    private function mapPropertyLikeValueOnTable(PropertyLike $propertyLike)
    {
        return [
            'property_id'=>$propertyLike->propertyId,
            'user_id'=>$propertyLike->userId,
            'updated_at' => $propertyLike->updatedAt,
        ];
    }

    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $feature = new PropertyLike();

        $feature->id = $result->id;
        $feature->propertyId = $result->property_id;
        $feature->userId = $result->user_id;
        $feature->createdAt = $result->created_at;
        $feature->updatedAt = $result->updated_at;
        return $feature;
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