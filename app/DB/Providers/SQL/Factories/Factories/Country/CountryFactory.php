<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\Country;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\Country\Gateways\CountryQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Country;

class CountryFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Country();
        $this->tableGateway = new CountryQueryBuilder();
    }

    /**
     * @return array Country::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    /**
     * @param string $id
     * @return Country::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    /**
     * @param Country $country
     * @return bool
     **/
    public function update(Country $country)
    {
        $country->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($country->id, $this->mapCountryOnTable($country));
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

    /**
     * @param Country $country
     * @return int
     **/
    public function store(Country $country)
    {
        $country->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapCountryOnTable($country));
    }

    /**
     * @param Country $country
     * @return int
     **/
    public function delete(Country $country)
    {
        return $this->tableGateway->delete($country->id);
    }

    /**
     * @param $result
     * @return Country::class
     **/
    public function map($result)
    {
        $country = clone($this->model);
        $country->id = $result->id;
        $country->name = $result->country;
        $country->createdAt = $result->created_at;
        $country->updatedAt = $result->updated_at;
        return $country;
    }

    /**
     * @param Country $country
     * @return array
     */
    private function mapCountryOnTable(Country $country)
    {
        return [
            'country' => $country->name,
            'updated_at' => $country->updatedAt,
        ];
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
