<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\Role\Gateways;

use App\DB\Providers\SQL\Factories\Factories\UserRole\UserRolesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class RoleQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "roles";
    }

    public function getUserRoles($userId)
    {
        $UserRolesTable = (new UserRolesFactory())->getTable();

        return  DB::table($UserRolesTable)
            ->leftjoin($this->table,$UserRolesTable.'.role_id', "=",$this->table.'.id')
            ->select($this->table.'.*')
            ->where($UserRolesTable.'.user_id', "=" ,$userId )
            ->get();
    }
}