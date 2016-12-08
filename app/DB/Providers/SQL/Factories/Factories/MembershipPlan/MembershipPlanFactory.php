<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\MembershipPlan;

use App\DB\Providers\SQL\Factories\Factories\MembershipPlan\Gateways\MembershipPlanQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\MembershipPlan;

class MembershipPlanFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new MembershipPlan();
        $this->tableGateway = new MembershipPlanQueryBuilder();
    }

    /**
     * @return array MembershipPlan::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    /**
     * @param string $id
     * @return MembershipPlan::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    /**
     * @param MembershipPlan $plan
     * @return bool
     **/
    public function update(MembershipPlan $plan)
    {
        return $this->tableGateway->update($plan->id, $this->mapPlanOnTable($plan));
    }

    /**
     * @param array $where
     * @param array $data
     * @return bool
     **/
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    /**
     * @param MembershipPlan $plan
     * @return int
     **/
    public function store(MembershipPlan $plan)
    {
        return $this->tableGateway->insert($this->mapPlanOnTable($plan));
    }

    /**
     * @param $result
     * @return MembershipPlan::class
     **/
    public function map($result)
    {
        $plan = clone($this->model);
        $plan->id = $result->id;
        $plan->name = $result->plan_name;
        $plan->featured = $result->featured;
        $plan->hot = $result->hot;
        $plan->description = $result->description;
        $plan->createdAt = $result->updated_at;
        $plan->createdAt = $result->created_at;
        return $plan;
    }


    private function mapPlanOnTable(MembershipPlan $plan)
    {
        return [
            'plan_name' => $plan->name,
            'featured' => $plan->featured,
            'hot' => $plan->hot,
            'description' => $plan->description,
            'updated_at' => $plan->updatedAt,
        ];
    }
}
