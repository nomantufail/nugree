<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\BannersPages\BannersPagesFactory;
use App\Repositories\Interfaces\Repositories\BannersRepoInterface;


class BannerPagesRepository extends SqlRepository implements BannersRepoInterface
{
    private $factory;
    public $bannerSociety ="";
    public $bannerSizes ="";
    public $bannerPages ="";
    public function __construct()
    {
         $this->factory = new BannersPagesFactory();
    }
    public function getByBannerId($bannerId)
    {
        return $this->factory->getByBannerId($bannerId);
    }
    public function deleteBannerPages($bannerId)
    {
        return $this->factory->deleteBannerPages($bannerId);
    }
}