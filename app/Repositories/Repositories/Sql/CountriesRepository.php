<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\Country\CountryFactory;
use App\DB\Providers\SQL\Models\Country;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;

class CountriesRepository extends SqlRepository implements UsersRepoInterface
{
    private $countryTransformer;
    private $factory = null;
    public function __construct(){
        $this->userTransformer = null;
        $this->factory = new CountryFactory();
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(Country $country)
    {
        $this->factory->update($country);
        return $this->factory->find($country->id);
    }

    public function store(Country $country)
    {
        return $this->factory->store($country);
    }

    public function delete(Country $country)
    {
        return $this->factory->delete($country);
    }
    public function getByCity($cityId)
    {
       return $this->factory->getByCity($cityId);
    }
}
