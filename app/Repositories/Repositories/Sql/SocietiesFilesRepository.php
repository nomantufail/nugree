<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\SocietyFiles\SocietyFilesFactory;
use App\Repositories\Interfaces\Repositories\SocietiesRepoInterface;

class SocietiesFilesRepository extends SqlRepository implements SocietiesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new SocietyFilesFactory();
    }
    public function getSocietyFiles($societyId)
    {
        return $this->factory->getSocietyFiles($societyId);
    }
}