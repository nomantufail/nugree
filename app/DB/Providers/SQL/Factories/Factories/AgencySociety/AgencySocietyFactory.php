<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\AgencySociety;

use App\DB\Providers\SQL\Factories\Factories\AgencySociety\Gateways\AgencySocietyQueryBuilder;
use App\DB\Providers\SQL\Factories\Factories\Block\Gateways\BlockQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\AgencySociety;
use App\DB\Providers\SQL\Models\Block;


class AgencySocietyFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new AgencySociety();
        $this->tableGateway = new AgencySocietyQueryBuilder();
    }
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function get($agencyId)
    {
        return $this->mapCollection($this->tableGateway->getWhere(['agency_id'=>$agencyId]));
    }
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function addSocieties(array $agencySocieties)
    {
        $agencySocietiesRecord =[];
        foreach($agencySocieties as $agencySociety)
        {
            $agencySocietiesRecord[] =  $this->mapAgencySocietyOnTable($agencySociety);
        }
        return $this->tableGateway->insertMultiple($agencySocietiesRecord);
    }

    public function deleteAgencySocieties($agencyId, array $societyIds)
    {
        return $this->tableGateway->deleteAgencySocieties($agencyId, $societyIds);
    }

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
        $agencySociety = clone($this->model);
        $agencySociety->id = $result->id;
        $agencySociety->societyId = $result->society_id;
        $agencySociety->agencyId = $result->agency_id;
        $agencySociety->createdAt = $result->created_at;
        $agencySociety->updatedAt = $result->updated_at;
        return $agencySociety;
    }
    private function mapAgencySocietyOnTable(AgencySociety $agencySociety)
    {
        return [
            'agency_id' => $agencySociety->agencyId,
            'society_id' => $agencySociety->societyId,
            'updated_at' => $agencySociety->updatedAt,
        ];
    }
}