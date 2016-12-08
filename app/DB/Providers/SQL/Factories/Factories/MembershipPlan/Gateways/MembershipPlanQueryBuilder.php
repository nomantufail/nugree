<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\MembershipPlan\Gateways;


use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\DB\Providers\SQL\Models\MembershipPlan;
use Illuminate\Support\Facades\DB;

class MembershipPlanQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "membership_plans";
    }

}