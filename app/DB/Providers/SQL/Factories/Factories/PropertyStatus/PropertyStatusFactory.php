<?php

namespace App\DB\Providers\SQL\Factories\Factories\PropertyStatus;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\PropertyStatus\Gateways\PropertyStatusQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\PropertyStatus;

class PropertyStatusFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyStatus();
        $this->tableGateway = new PropertyStatusQueryBuilder();
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    public function update(PropertyStatus $propertyStatus)
    {
        $propertyStatus->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($propertyStatus->id ,$this->mapPropertyStatusOnTable($propertyStatus));
    }
    public function store(PropertyStatus $propertyStatus)
    {
        $propertyStatus->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyStatusOnTable($propertyStatus));
    }
    public function delete(PropertyStatus $propertyStatus)
    {
        return $this->tableGateway->delete($propertyStatus->id);
    }
    private function mapPropertyStatusOnTable(PropertyStatus $propertyStatus)
    {
        return [
            'status'=>$propertyStatus->name,
            'updated_at' => $propertyStatus->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $propertyStatus = clone($this->model);
        $propertyStatus->id = $result->id;
        $propertyStatus->name = $result->status;
        $propertyStatus->createdAt = $result->created_at;
        $propertyStatus->updatedAt = $result->updated_at;
        return $propertyStatus;
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