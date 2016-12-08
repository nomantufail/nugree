<?php
namespace App\DB\Providers\SQL\Factories\Factories\SocietyMaps;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\SocietyMaps\Gateways\SocietyMapsQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Society;
use App\DB\Providers\SQL\Models\SocietyMaps;

class SocietyMapsFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new SocietyMaps();
        $this->tableGateway = new SocietyMapsQueryBuilder();
    }
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function getSocietyMaps($societyId)
    {
        return $this->tableGateway->getSocietyMaps($societyId);
    }
    public function find($id)
    {}
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }


    public function map($result)
    {
        $society = clone($this->model);
        $society->id = $result->id;
        $society->societyId = $result->society_id;
        $society->path = $result->path;
        $society->createdAt = $result->created_at;
        $society->updatedAt = $result->updated_at;
        return $society;
    }

    private function mapSocietyOnTable(Society $society)
    {
        return [
            'society_id'    => $society->name,
            'path'    => $society->cityId,
            'updated_at' => $society->updatedAt,
        ];
    }
}