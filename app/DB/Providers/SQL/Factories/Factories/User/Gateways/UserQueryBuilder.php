<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\User\Gateways;


use App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencySociety\AgencySocietyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\AgencyStaffFactory;
use App\DB\Providers\SQL\Factories\Factories\User\UserFactory;
use App\DB\Providers\SQL\Factories\Factories\UserRole\UserRolesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class UserQueryBuilder extends QueryBuilder{

    public function __construct(){
        $this->table = "users";
    }

    public function addRoles($userId, $roles)
    {
        $userRoles = [];
        foreach($roles as $roleId){
            $userRoles[] = [
                'user_id' => $userId, 'role_id' => $roleId,
                'created_at'=>date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')
            ];
        }

        return $this->insertMultiple($userRoles, 'user_roles');
    }

}