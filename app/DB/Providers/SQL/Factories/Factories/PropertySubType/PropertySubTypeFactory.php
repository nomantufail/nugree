<?php

namespace App\DB\Providers\SQL\Factories\Factories\PropertySubType;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\PropertySubType\Gateways\PropertySubTypeQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\AssignFeature;
use App\DB\Providers\SQL\Models\Property\PropertyCompleteType;
use App\DB\Providers\SQL\Models\PropertySubType;
use App\DB\Providers\SQL\Models\PropertyType;

class PropertySubTypeFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertySubType();
        $this->tableGateway = new PropertySubTypeQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    /**
     * @param int $propertyId
     * @Desc: return property type with parent and sub type .
     * @return PropertyCompleteType::class
     */
    public function propertyCompleteType($propertyId)
    {
        return $this->mapPropertyCompleteType($this->tableGateway->propertyCompleteType($propertyId));
    }

    public function update(PropertySubType $propertySubType)
    {
        $propertySubType->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($propertySubType->id ,$this->mapPropertyTypeOnTable($propertySubType));
    }
    public function store(PropertySubType $propertySubType)
    {
        $propertySubType->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyTypeOnTable($propertySubType));
    }
    public function delete(PropertySubType $propertySubType)
    {
        return $this->tableGateway->delete($propertySubType->id);
    }
    public function getByType($id)
    {
        return $this->mapCollection($this->tableGateway->getWhere(['property_type_id'=>$id]));
    }

    private function mapPropertyCompleteType($result)
    {
        $propertyCompleteType = new PropertyCompleteType();

        $propertyParentType = new PropertyType();
        $propertyParentType->id = $result->parentTypeId;
        $propertyParentType->name = $result->parentTypeName;

        $propertyCompleteType->parentType = $propertyParentType;

        $propertySubType = new PropertySubType();
        $propertySubType->id = $result->subTypeId;
        $propertySubType->name = $result->subTypeName;

        $propertyCompleteType->subType = $propertySubType;

        return $propertyCompleteType;
    }
    public function assignFeature(AssignFeature $assignFeature)
    {
        return $this->tableGateway->insert($this->map($assignFeature));
    }

    private function mapPropertyTypeOnTable(PropertySubType $propertySubType)
    {
        return [
            'sub_type'=>$propertySubType->name,
            'property_type_id'=>$propertySubType->propertyTypeId,
            'updated_at' => $propertySubType->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $propertySubType = new PropertySubType();
        $propertySubType->id=$result->id;
        $propertySubType->name= $result->sub_type;
        $propertySubType->propertyTypeId= $result->property_type_id;
        $propertySubType->createdAt = $result->created_at;
        $propertySubType->updatedAt = $result->updated_at;
        return $propertySubType;
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