<?php
namespace App\DB\Providers\SQL\Factories\Factories\PropertyPurpose;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */


use App\DB\Providers\SQL\Factories\Factories\PropertyPurpose\Gateways\PropertyPurposeQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\PropertyPurpose;

class PropertyPurposeFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyPurpose();
        $this->tableGateway = new PropertyPurposeQueryBuilder();
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
     * @return propertyPurpose::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    /**
     * @param PropertyPurpose $propertyPurpose
     * @return bool
     **/
    public function update(PropertyPurpose $propertyPurpose)
    {
        $propertyPurpose->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($propertyPurpose->id, $this->mapPropertyPurposeOnTable($propertyPurpose));
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
    public function store(PropertyPurpose $PropertyPurpose)
    {
        $PropertyPurpose->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyPurposeOnTable($PropertyPurpose));
    }
    /**
     * @param PropertyPurpose $PropertyPurpose
     * @return int
     **/
    public function delete(PropertyPurpose $PropertyPurpose)
    {
        return $this->tableGateway->delete($PropertyPurpose->id);
    }
    public function map($result)
    {
        $purpose = clone($this->model);
        $purpose->id = $result->id;
        $purpose->name = $result->purpose;
        $purpose->displayName = $result->display_name;
        $purpose->createdAt = $result->created_at;
        $purpose->updatedAt = $result->updated_at;
        return $purpose;
    }
    private function mapPropertyPurposeOnTable(PropertyPurpose $propertyPurpose)
    {
        return [
            'purpose'    => $propertyPurpose->name,
            'display_name' => $propertyPurpose->displayName,
            'updated_at' => $propertyPurpose->updatedAt,
        ];
    }
}