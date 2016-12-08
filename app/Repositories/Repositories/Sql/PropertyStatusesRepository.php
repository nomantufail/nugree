<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;
use App\DB\Providers\SQL\Factories\Factories\PropertyStatus\PropertyStatusFactory;
use App\DB\Providers\SQL\Models\PropertyStatus;
use App\Repositories\Interfaces\Repositories\LandUnitRepoInterface;


class PropertyStatusesRepository extends SqlRepository implements LandUnitRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new PropertyStatusFactory();

    }
    public function store(PropertyStatus $propertyStatus)
    {
        return $this->factory->store($propertyStatus);
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(PropertyStatus $propertyStatus)
    {
        $this->factory->update($propertyStatus);
        return $this->factory->find($propertyStatus->id);
    }

    public function delete(PropertyStatus $propertyStatus)
    {
        return $this->factory->delete($propertyStatus);
    }
}