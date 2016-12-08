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
use App\Repositories\Interfaces\Repositories\BannersRepoInterface;


class BannerSocietiesRepository extends SqlRepository implements BannersRepoInterface
{
    private $factory;
    public $bannerSociety ="";
    public $bannerSizes ="";
    public $bannerPages ="";
    public function __construct()
    {
         $this->factory = new BannersSocietiesFactory();
        $this->bannerSociety = new BannersSocietiesFactory();
        $this->bannerSizes = new BannersSizesFactory();
        $this->bannerPages = new BannersPagesFactory();

    }
    public function getByBanner($bannerId)
    {
        return $this->factory->getByBanner($bannerId);
    }
    public function deleteBannerSocieties($bannerId)
    {
        return $this->factory->deleteBannerSocieties($bannerId);
    }

}