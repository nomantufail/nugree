<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Banners\BannersFactory;
use App\DB\Providers\SQL\Factories\Factories\Pages\PagesFactory;
use App\Repositories\Interfaces\Repositories\BannersRepoInterface;


class PagesRepository extends SqlRepository implements BannersRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new PagesFactory();
    }
    public function all()
    {
        return $this->factory->all();
    }

}