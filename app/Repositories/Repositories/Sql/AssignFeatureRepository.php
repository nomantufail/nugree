<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\AssignFeature\AssignFeatureFactory;
use App\DB\Providers\SQL\Models\AssignFeature;
use App\Repositories\Interfaces\Repositories\BlocksRepoInterface;


class AssignFeatureRepository extends SqlRepository implements BlocksRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new AssignFeatureFactory();
    }

    public function store(AssignFeature $assignFeature)
    {
        return $this->factory->store($assignFeature);
    }

}