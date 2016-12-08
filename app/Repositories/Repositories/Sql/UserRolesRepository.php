<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\UserRole\UserRolesFactory;
use App\DB\Providers\SQL\Models\UserRole;
use App\Repositories\Interfaces\Repositories\UserRoleRepoInterface;

class UserRolesRepository extends SqlRepository implements UserRoleRepoInterface
{
    private $factory = null;
    public function __construct()
    {
        $this->factory = new UserRolesFactory();
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }
    public function getUserRole($id)
    {
        return $this->factory->getUserRole($id);
    }
    public function all()
    {
       return  $this->factory->all();
    }
    public function store(UserRole $userRole)
    {
        $userRole->id = $this->factory->store($userRole);
        return $userRole->id;
    }

    public function storeMultiple(array $userRoles)
    {
        return $this->factory->storeMultiple($userRoles);
    }

    public function update(UserRole $userRole)
    {
        $this->factory->update($userRole);
        return $this->factory->find($userRole->id);
    }

    /**
     * @param UserRole $userRole
     * @return mixed
     */
    public function delete(UserRole $userRole)
    {
        $userRole = $this->factory->delete($userRole);
        return $userRole;
    }

    public function deleteByUserId($userId)
    {
        return $this->factory->deleteByUserId($userId);
    }

}
