<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\SocietyMaps\SocietyMapsFactory;
use App\Repositories\Interfaces\Repositories\SocietiesRepoInterface;

class SocietiesMapsRepository extends SqlRepository implements SocietiesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new SocietyMapsFactory();
    }


    public function getSocietyMaps($societyId)
    {
        return $this->factory->getSocietyMaps($societyId);
    }

}