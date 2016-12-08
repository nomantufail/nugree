<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Models\Society;
use App\Repositories\Interfaces\Repositories\SocietiesRepoInterface;

class SocietiesRepository extends SqlRepository implements SocietiesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new SocietyFactory();
    }
    public function store(Society $society)
    {
        return $this->factory->store($society);
    }
    public function find($societyId)
    {
        return $this->factory->find($societyId);
    }
    public function getSocietiesYouDealIn($agencyName)
    {
        return $this->factory->getSocietiesYouDealIn($agencyName);
    }
    public function getImportantSocieties()
    {
        return $this->factory->getImportantSocieties();
    }
    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }
    public function getSocietiesForFiles()
    {
        return $this->factory->getSocietiesForFile();
    }
    public function update(Society $society)
    {
        $this->factory->update($society);
        return $this->factory->find($society->id);
    }

    public function delete(Society $society)
    {
        return $this->factory->delete($society);
    }
    public function getSocietiesByAgency($agencyId)
    {
        return $this->factory->getSocietiesByAgency($agencyId);
    }
    public function getByCity($cityId)
    {
        return $this->factory->getByCity($cityId);
    }
}