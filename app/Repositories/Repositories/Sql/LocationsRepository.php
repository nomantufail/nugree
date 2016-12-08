<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Location\LocationFactory;
use App\DB\Providers\SQL\Models\Location;
use App\Repositories\Interfaces\Repositories\SocietiesRepoInterface;

class LocationsRepository extends SqlRepository implements SocietiesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new LocationFactory();
    }
    public function first()
    {
        return $this->factory->first();
    }
    public function getLocationBySlug($locationSlug)
    {
        return $this->factory->getLocationBySlug($locationSlug);
    }
    public function store(Location $location)
    {
        return $this->factory->store($location);
    }
    public function find($locationId)
    {
        return $this->factory->find($locationId);
    }
    public function getById($id)
    {
        return $this->factory->find($id);
    }
    public function getCityLocationCount($city)
    {
        return $this->factory->getCityLocationCount($city);
    }
    public function getByIds(array $ids)
    {
        return $this->factory->getByIds($ids);
    }

    public function all()
    {
        return $this->factory->all();
    }
    public function update(Location $location)
    {
        $this->factory->update($location);
        return $this->factory->find($location->id);
    }

    public function delete(Location $location)
    {
        return $this->factory->delete($location);
    }
    public function search($params)
    {
        return $this->factory->search($params);
    }
    public function getLocationsByAgency($agencyId)
    {
        return $this->factory->getLocationsByAgency($agencyId);
    }
    public function getLocationByCity($params)
    {
        return $this->factory->getLocationByCity($params);
    }
    public function getByCity($params)
    {
        return $this->factory->getByCity($params);
    }
    public function locationCount()
    {
        return $this->factory->locationCount();
    }
}