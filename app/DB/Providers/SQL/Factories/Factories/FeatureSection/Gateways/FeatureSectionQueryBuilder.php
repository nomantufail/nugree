<?php

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\FeatureSection\Gateways;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
class FeatureSectionQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'feature_sections';
    }
}