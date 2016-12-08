<?php
namespace App\DB\Providers\SQL\Factories\Factories\Society;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\Gateways\SocietyQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Society;

class SocietyFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Society();
        $this->tableGateway = new SocietyQueryBuilder();
    }
    /**
     * @return array Country::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function getSocietiesForFile()
    {
        return $this->mapCollection($this->tableGateway->getSocietiesForFile());
    }
    public function getSocietiesYouDealIn($agencyName)
    {
        return $this->tableGateway->getSocietiesYouDealIn($agencyName);
    }
    public function getByCity($cityId)
    {
        return $this->mapCollection($this->tableGateway->getByCity($cityId));
    }
    public function getImportantSocieties()
    {
        return $this->mapCollection($this->tableGateway->getImportantSocieties());
    }
    /**
     * @param string $id
     * @return Society::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    /**
     * @param Society $society
     * @return bool
     **/
    public function update(Society $society)
    {
        $society->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($society->id, $this->mapSocietyOnTable($society));
    }

    /**
     * @param array $where
     * @param array $data
     * @return bool
     **/
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function store(Society $society)
    {
        $society->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapSocietyOnTable($society));
    }
    public function getSocietiesByAgency($agencyId)
    {
        return $this->mapCollection($this->tableGateway->getSocietiesByAgency($agencyId));
    }
    /**
     * @param Society $society
     * @return int
     **/
    public function delete(Society $society)
    {
        return $this->tableGateway->delete($society->id);
    }

    public function map($result)
    {
        $society = clone($this->model);
        $society->id = $result->id;
        $society->name = $result->society;
        $society->cityId = $result->city_id;
        $society->important = $result->important;
        $society->priority = $result->priority;
        $society->path = $result->path;
        $society->createdAt = $result->created_at;
        $society->updatedAt = $result->updated_at;
        return $society;
    }

    private function mapSocietyOnTable(Society $society)
    {
        return [
            'society'    => $society->name,
            'city_id'    => $society->cityId,
            'important'    => $society->important,
            'priority'    => $society->priority,
            'path'    => $society->path,
            'updated_at' => $society->updatedAt,
        ];
    }
}