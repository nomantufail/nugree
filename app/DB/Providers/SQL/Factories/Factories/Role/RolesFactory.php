<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\Role;

use App\DB\Providers\SQL\Factories\Factories\Role\Gateways\RoleQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Role;
use App\DB\Providers\SQL\Models\UserRole;

class RolesFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;

    public function __construct()
    {
        $this->model = new Role();
        $this->tableGateway = new RoleQueryBuilder();
    }
    public function getUserRoles($userId)
    {
        return $this->mapCollection($this->tableGateway->getUserRoles($userId));
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
    public function store(Role $role)
    {
        return $this->tableGateway->insert($this->mapRoleOnTable($role));
    }
    public function update(Role $role)
    {
        return $this->tableGateway->update($role->id,$this->mapRoleOnTable($role));
    }
    public function delete(Role $role)
    {
        return $this->tableGateway->delete($role->id);
    }
    public function getAllRoles(Role $role)
    {
        return $this->tableGateway->all();
    }

    /**
     * @param int $id
     * @return UserRole::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function map($result)
    {
        $role = clone($this->model);
        $role->id = $result->id;
        $role->name = $result->role;
        return $role;
    }
    /**
     * @param Role $role
     * @return array
     **/
    private function mapRoleOnTable(Role $role)
    {
        return [
            'id' => $role->id,
            'role' => $role->name,

            'created_at' => $role->createdAt,
            'updated_at' => $role->updatedAt,
        ];
    }
}
