<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\City\CityFactory;
use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\DB\Providers\SQL\Models\City;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;

class FavouritePropertyRepository extends SqlRepository implements UsersRepoInterface
{
    private $cityTransformer;
    private $factory = null;
    public function __construct(){
        $this->cityTransformer = null;
        $this->factory = new FavouritePropertyFactory();
    }

    public function getUserFavouritePropertiesIds($userId)
    {
        return $this->factory->getUserFavouritePropertiesIds($userId);
    }
    public function isFavourite($propertyId,$userId)
    {
        return $this->factory->isFavourite($propertyId,$userId);
    }
}
