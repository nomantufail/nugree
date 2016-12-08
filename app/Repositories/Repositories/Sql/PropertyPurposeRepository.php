<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\PropertyPurpose\PropertyPurposeFactory;
use App\DB\Providers\SQL\Models\PropertyPurpose;
use App\Repositories\Interfaces\Repositories\PropertyPurposeRepoInterface;

class PropertyPurposeRepository extends SqlRepository implements PropertyPurposeRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new PropertyPurposeFactory();
    }
    public function store(PropertyPurpose $propertyPurpose)
    {
        return $this->factory->store($propertyPurpose);
    }


    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(PropertyPurpose $propertyPurpose)
    {
        $this->factory->update($propertyPurpose);
        return $this->factory->find($propertyPurpose->id);
    }

    public function delete(PropertyPurpose $propertyPurpose)
    {
        return $this->factory->delete($propertyPurpose);
    }
}