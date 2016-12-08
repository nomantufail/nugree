<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserRole;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\UserRole\Gateways\UserRoleQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\UserRole;

class UserRolesFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new UserRole();
        $this->tableGateway = new UserRoleQueryBuilder();
    }
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function getUserRole($userId)
    {
        return $this->map($this->tableGateway->getWhere(['user_id'=>$userId]));
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    public function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    /**
     * @param int $id
     * @return UserRole::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    /**
     * @param UserRole $userRole
     * @return bool
     **/
    public function update(UserRole $userRole)
    {
        $userRole->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($userRole->id, $this->mapUserRoleOnTable($userRole));
    }
    public function delete(UserRole $userRole)
    {
        return $this->tableGateway->delete($userRole->id);
    }

    public function deleteByUserId($userId)
    {
        return $this->tableGateway->deleteWhere(['user_id'=>$userId]);
    }

    /**
     * @param UserRole $userRole
     * @return int
     **/
    public function store(UserRole $userRole)
    {
        $userRole->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapUserRoleOnTable($userRole));
    }

    public function storeMultiple($userRoles)
    {
        return $this->tableGateway->insertMultiple($this->mapUserRolesOnTable($userRoles));
    }

    /**
     * @param $result
     * @return UserRole::class
     **/
    public function map($result)
    {
        $user = clone($this->model);
        $user->id = $result->id;
        $user->roleId = $result->role_id;
        $user->userId = $result->user_id;
        return $user;
    }
    /**
     * @param userRole $userRole
     * @return array
     **/
    private function mapUserRoleOnTable(UserRole $userRole)
    {
        return [
            'role_id' => $userRole->roleId,
            'user_id' => $userRole->userId,

            'created_at' => $userRole->createdAt,
            'updated_at' => $userRole->updatedAt,
        ];
    }

    private function mapUserRolesOnTable(array $userRoles)
    {
        $mappedUserRoles = [];
        foreach($userRoles as $userRole)
        {
            $mappedUserRoles[] = $this->mapUserRoleOnTable($userRole);
        }
        return $mappedUserRoles;
    }
}
