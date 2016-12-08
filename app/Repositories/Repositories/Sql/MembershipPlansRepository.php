<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\MembershipPlan\MembershipPlanFactory;
use App\DB\Providers\SQL\Models\MembershipPlan;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;

class MembershipPlansRepository extends SqlRepository implements UsersRepoInterface
{
    private $factory = null;
    public function __construct(){
        $this->userTransformer = null;
        $this->factory = new MembershipPlanFactory();
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update($id, $info)
    {

    }

    public function store(MembershipPlan $plan)
    {
        $plan->id = $this->factory->store($plan);
        return $plan;
    }
}
