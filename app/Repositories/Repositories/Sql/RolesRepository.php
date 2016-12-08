<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\Role\RolesFactory;
use App\DB\Providers\SQL\Models\Role;
use App\Repositories\Interfaces\Repositories\UserRoleRepoInterface;

class RolesRepository extends SqlRepository implements UserRoleRepoInterface
{
    private $factory = null;
    public function __construct()
    {
        $this->factory = new RolesFactory();
    }
    public function getUserRoles($userId)
    {
        return $this->factory->getUserRoles($userId);
    }
    public function store(Role $role)
    {
        return $this->factory->store($role);
    }
    public function update(Role $role)
    {
        return $this->factory->update($role);
    }
    public function delete(Role $role)
    {
        return $this->factory->delete($role);
    }
    public function all()
    {
        return $this->factory->all();
    }
    public function getRoleById($roleId)
    {
        return $this->factory->find($roleId);
    }
}
