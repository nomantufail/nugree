<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\AgencyLocation;

use App\DB\Providers\SQL\Factories\Factories\AgencyLocation\Gateways\AgencyLocationQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\AgencyLocation;
use App\DB\Providers\SQL\Models\AgencySociety;


class AgencyLocationFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new AgencyLocation();
        $this->tableGateway = new AgencyLocationQueryBuilder();
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
    public function addLocation(array $agencyLocations)
    {
        $agencyLocationsRecord =[];
        foreach($agencyLocations as $agencyLocation)
        {
            $agencyLocationsRecord[] =  $this->mapAgencyLocationOnTable($agencyLocation);
        }
        return $this->tableGateway->insertMultiple($agencyLocationsRecord);
    }

    public function deleteAgencyLocations($agencyId, array $locationIds)
    {
        return $this->tableGateway->deleteAgencyLocations($agencyId, $locationIds);
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
        $agencySociety->locationId = $result->location_id;
        $agencySociety->agencyId = $result->agency_id;
        $agencySociety->createdAt = $result->created_at;
        $agencySociety->updatedAt = $result->updated_at;
        return $agencySociety;
    }
    private function mapAgencyLocationOnTable(AgencyLocation $agencyLocation)
    {
        return [
            'agency_id' => $agencyLocation->agencyId,
            'location_id' => $agencyLocation->locationId,
            'updated_at' => $agencyLocation->updatedAt,
        ];
    }
}