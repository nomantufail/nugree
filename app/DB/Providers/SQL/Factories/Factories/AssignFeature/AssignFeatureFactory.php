<?php

namespace App\DB\Providers\SQL\Factories\Factories\AssignFeature;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\AssignFeature\Gateways\AssignFeatureQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\AssignFeature;

class AssignFeatureFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new AssignFeature();
        $this->tableGateway = new AssignFeatureQueryBuilder();
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    /**
     * @param AssignFeature $assignFeature
     * @return mixed
     */
    public function store(AssignFeature $assignFeature)
    {
        $assignFeature->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapCityOnTable($assignFeature));
    }

    public function delete(AssignFeature $assignFeature)
    {
        return $this->tableGateway->delete($assignFeature->id);
    }

    private function mapCityOnTable(AssignFeature $assignFeature)
    {
        return [
            'property_sub_type_id' => $assignFeature->propertySubTypeId,
            'property_feature_id'=>$assignFeature->featureId,
            'updated_at' => $assignFeature->updatedAt,
        ];
    }

    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }



    public function map($result)
    {
        $assignFeature = new AssignFeature();
        $assignFeature->id = $result->id;
        $assignFeature->propertySubTypeId = $result->property_sub_type_id;
        $assignFeature->featureId = $result->property_feature_id;
        $assignFeature->createdAt = $result->created_at;
        $assignFeature->updatedAt = $result->updated_at;
        return $assignFeature;
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