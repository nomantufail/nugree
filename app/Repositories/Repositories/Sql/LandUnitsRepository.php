<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;
use App\DB\Providers\SQL\Factories\Factories\LandUnit\LandUnitFactory;

use App\DB\Providers\SQL\Models\LandUnit;

use App\Repositories\Interfaces\Repositories\LandUnitRepoInterface;
class LandUnitsRepository extends SqlRepository implements LandUnitRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new LandUnitFactory();

    }
    public function store(LandUnit $landUnit)
    {
        return $this->factory->store($landUnit);
    }


    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(LandUnit $landUnit)
    {
        $this->factory->update($landUnit);
        return $this->factory->find($landUnit->id);
    }

    public function delete(LandUnit $landUnit)
    {
        return $this->factory->delete($landUnit);
    }
}