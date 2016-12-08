<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserRequirement;

use App\DB\Providers\SQL\Factories\Factories\UserRequirement\Gateways\UserRequirementQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\UserRequirement;

class UserRequirementFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new UserRequirement();
        $this->tableGateway = new UserRequirementQueryBuilder();
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

    public function store(UserRequirement $requirement)
    {
        $requirement->createdAt = date('Y-m-d h:i:s');
        $requirement->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapUserRequirementOnTable($requirement));
    }

    public function delete(UserRequirement $requirement)
    {
        return $this->tableGateway->delete($requirement->id);
    }

    public function map($result)
    {
        $userRequirement = clone($this->model);
        $userRequirement->id = $result->id;
        $userRequirement->name = $result->name;
        $userRequirement->email = $result->email;
        $userRequirement->phone = $result->phone;
        $userRequirement->subject = $result->subject;
        $userRequirement->requirement = $result->requirement;
        $userRequirement->createdAt = $result->created_at;
        $userRequirement->updatedAt = $result->updated_at;
        return $userRequirement;
    }

    private function mapUserRequirementOnTable(UserRequirement $userRequirement)
    {
        return [
            'name' => $userRequirement->name,
            'requirement' => $userRequirement->requirement,
            'phone' => $userRequirement->phone,
            'email' => $userRequirement->email,
            'subject' => $userRequirement->subject,
            'updated_at' => $userRequirement->updatedAt,
            'created_at' => $userRequirement->createdAt,
        ];
    }
}
