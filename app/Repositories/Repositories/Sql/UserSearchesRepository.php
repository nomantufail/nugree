<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\BannersPages\BannersPagesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSizes\BannersSizesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSocieties\BannersSocietiesFactory;
use App\DB\Providers\SQL\Factories\Factories\UserSearches\UserSearchesFactory;
use App\Repositories\Interfaces\Repositories\BannersRepoInterface;


class UserSearchesRepository extends SqlRepository implements BannersRepoInterface
{
    private $factory;
    public function __construct()
    {
        $this->factory = new UserSearchesFactory();
    }
    public function store($userSearches)
    {
        return $this->factory->store($userSearches);
    }


}