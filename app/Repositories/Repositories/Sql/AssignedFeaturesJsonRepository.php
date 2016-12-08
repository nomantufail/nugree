<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\AssignedFeatures\AssignedFeaturesJsonFactory;
use App\DB\Providers\SQL\Models\AssignedFeatures;
use App\Repositories\Interfaces\Repositories\AssignedFeaturesRepoInterface;


class AssignedFeaturesJsonRepository extends SqlRepository implements AssignedFeaturesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new AssignedFeaturesJsonFactory();
    }

    public function store(AssignedFeatures $assignedFeatures)
    {
        return $this->factory->store($assignedFeatures);
    }
    public function updateWhere(array $condition,AssignedFeatures $assignedFeatures)
    {
        return $this->factory->updateWhere($condition,$assignedFeatures);
    }
    public function all()
    {
        return $this->factory->all();
    }
}