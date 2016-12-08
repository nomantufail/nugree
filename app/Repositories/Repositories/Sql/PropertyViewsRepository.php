<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\PropertyViews\PropertyViewsFactory;
use App\Repositories\Interfaces\Repositories\PropertyViewsRepoInterface;

class PropertyViewsRepository extends SqlRepository implements PropertyViewsRepoInterface
{
    private $factory = null;
    public function __construct()
    {
        $this->factory = new PropertyViewsFactory();
    }

    public function incrementViews(array $propertyIds)
    {
        return $this->factory->incrementViews($propertyIds);
    }
    public function insertMultiple(array $propertyViews)
    {
        return $this->factory->insertMultiple($propertyViews);
    }
}
