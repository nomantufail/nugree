<?php

namespace App\DB\Providers\SQL\Factories\Factories\LandUnit;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\LandUnit\Gateways\LandUnitQueryBuilder;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\LandUnit;

class LandUnitFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new LandUnit();
        $this->tableGateway = new LandUnitQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->getSortedLandUnits());
    }
    public function update(LandUnit $landUnit)
    {
        $landUnit->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($landUnit->id ,$this->mapPropertyTypeOnTable($landUnit));
    }
    public function store(LandUnit $landUnit)
    {
        $landUnit->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyTypeOnTable($landUnit));
    }
    public function delete(LandUnit $landUnit)
    {
        return $this->tableGateway->delete($landUnit->id);
    }
    private function mapPropertyTypeOnTable(LandUnit $landUnit)
    {
        return [
            'unit'=>$landUnit->name,
            'updated_at' => $landUnit->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $landUnit = clone($this->model);
        $landUnit->id=$result->id;
        $landUnit->name = $result->unit;
        $landUnit->createdAt = $result->created_at;
        $landUnit->updatedAt = $result->updated_at;
        return $landUnit;
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