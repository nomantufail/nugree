<?php

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\PropertyFeatureValue;

use App\DB\Providers\SQL\Factories\Factories\Feature\Gateways\FeatureQueryBuilder;

use App\DB\Providers\SQL\Factories\Factories\PropertyFeatureValue\Gateways\PropertyFeatureValueQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\DB\Providers\SQL\Models\Features\PropertyFeatureValue;
use App\DB\Providers\SQL\Models\FeatureSection;

class PropertyFeatureValueFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->tableGateway = new PropertyFeatureValueQueryBuilder();
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

    public function update(PropertyFeatureValue $feature)
    {
        $feature->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($feature->id ,$this->mapPropertyFeatureValueOnTable($feature));
    }

    public function store(PropertyFeatureValue $feature)
    {
        $feature->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyFeatureValueOnTable($feature));
    }

    public function storeMultiple(array $featureValues)
    {
        $storeAbleFeatureValues = [];
        foreach($featureValues as $feature)
        {
            $storeAbleFeatureValues[] = $this->mapPropertyFeatureValueOnTable($feature);
        }
        return $this->tableGateway->insertMultiple($storeAbleFeatureValues);
    }

    public function delete(PropertyFeatureValue $feature)
    {
        return $this->tableGateway->delete($feature->id);
    }

    public function deletePropertyFeatures($propertyId)
    {
        return $this->tableGateway->deleteWhere(['property_id'=>$propertyId]);
    }

    private function mapPropertyFeatureValueOnTable(PropertyFeatureValue $feature)
    {
        return [
            'id'=>$feature->id,
            'property_id'=>$feature->propertyId,
            'property_feature_id'=>$feature->propertyFeatureId,
            'value'=>$feature->value,
            'updated_at' => $feature->updatedAt,
        ];
    }

    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $feature = new PropertyFeatureValue();

        $feature->id = $result->id;
        $feature->propertyId = $result->propertyId;
        $feature->propertyFeatureId = $result->property_feature_id;
        $feature->value = $result->value;

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