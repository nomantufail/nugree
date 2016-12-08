<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserRole\Gateways;


use App\DB\Providers\SQL\Factories\Factories\Role\Gateways\RoleQueryBuilder;
use App\DB\Providers\SQL\Factories\Factories\Role\RolesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class UserRoleQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "user_roles";
    }


}