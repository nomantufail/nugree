<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\JoinUs;

use App\DB\Providers\SQL\Factories\Factories\JoinUs\Gateways\JoinUsQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\JoinUs;

class JoinUsFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new JoinUs();
        $this->tableGateway = new JoinUsQueryBuilder();
    }


    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }

    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function findBy($column, $value)
    {
        return $this->map($this->tableGateway->findBy($column, $value));
    }

    public function getByUser($userId)
    {
        return $this->mapCollection($this->tableGateway->getWhere(['user_id' => $userId]));
    }

    public function store(JoinUs $joinUs)
    {
        $joinUs->createdAt = date('Y-m-d h:i:s');
        $joinUs->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapUserRequirementOnTable($joinUs));
    }

    public function delete(JoinUs $joinUs)
    {
        return $this->tableGateway->delete($joinUs->id);
    }

    public function map($result)
    {
        $userRequirement = clone($this->model);
        $userRequirement->id = $result->id;
        $userRequirement->name = $result->name;
        $userRequirement->email = $result->email;
        $userRequirement->phone = $result->phone;
        $userRequirement->address = $result->address;
        $userRequirement->message = $result->message;
        $userRequirement->purpose = $result->purpose_id;
        $userRequirement->createdAt = $result->created_at;
        $userRequirement->updatedAt = $result->updated_at;
        return $userRequirement;
    }

    private function mapUserRequirementOnTable(JoinUs $joinUs)
    {
        return [
            'name' => $joinUs->name,
            'message' => $joinUs->message,
            'phone' => $joinUs->phone,
            'email' => $joinUs->email,
            'address'=>$joinUs->address,
            'purpose' => $joinUs->purpose,
            'updated_at' => $joinUs->updatedAt,
            'created_at' => $joinUs->createdAt,
        ];
    }
}
