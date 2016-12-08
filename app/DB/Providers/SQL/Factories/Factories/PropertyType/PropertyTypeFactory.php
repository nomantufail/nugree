<?php

namespace App\DB\Providers\SQL\Factories\Factories\PropertyType;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\PropertyType\Gateways\PropertyTypeQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;

use App\DB\Providers\SQL\Models\PropertyType;

class PropertyTypeFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyType();
        $this->tableGateway = new PropertyTypeQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->getSortedPropertyTypes());
    }

    public function update(PropertyType $propertyType)
    {
        $propertyType->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($propertyType->id ,$this->mapPropertyTypeOnTable($propertyType));
    }
    public function store(PropertyType $propertyType)
    {
        $propertyType->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyTypeOnTable($propertyType));
    }
    public function delete(PropertyType $propertyType)
    {
        return $this->tableGateway->delete($propertyType->id);
    }
    private function mapPropertyTypeOnTable(PropertyType $propertyType)
    {
        return [
            'type'=>$propertyType->name,
            'updated_at' => $propertyType->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $propertyType            = clone($this->model);
        $propertyType->id        = $result->id;
        $propertyType->name      = $result->type;
        $propertyType->createdAt = $result->created_at;
        $propertyType->updatedAt = $result->updated_at;
        return $propertyType;
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function getBySubType($id)
    {
        return $this->tableGateway->getBySubType($id);
    }
}