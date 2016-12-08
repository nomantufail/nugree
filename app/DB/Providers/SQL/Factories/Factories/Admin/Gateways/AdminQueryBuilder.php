<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\Admin\Gateways;


use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\AgencyStaffFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class AdminQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "admins";
    }



}