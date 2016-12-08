<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\PropertySubType\PropertySubTypeFactory;

use App\DB\Providers\SQL\Models\AssignFeature;
use App\DB\Providers\SQL\Models\PropertySubType;

use App\Repositories\Interfaces\Repositories\PropertySubTypeRepoInterface;


class PropertySubTypeRepository extends SqlRepository implements PropertySubTypeRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new PropertySubTypeFactory();

    }
    public function store(PropertySubType $propertySubType)
    {
        return $this->factory->store($propertySubType);
    }


    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(PropertySubType $propertySubType)
    {
        $this->factory->update($propertySubType);
        return $this->factory->find($propertySubType->id);
    }

    public function delete(PropertySubType $propertySubType)
    {
        return $this->factory->delete($propertySubType);
    }
    public function getByType($id)
    {
        return $this->factory->getByType($id);
    }


}