<?php
namespace App\DB\Providers\SQL\Factories\Factories\PropertyStatus\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;

class PropertyStatusQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'property_statuses';
    }
}