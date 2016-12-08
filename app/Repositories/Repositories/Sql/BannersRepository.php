<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Banners\BannersFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersPages\BannersPagesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSizes\BannersSizesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSocieties\BannersSocietiesFactory;
use App\DB\Providers\SQL\Models\Banner;
use App\Repositories\Interfaces\Repositories\BannersRepoInterface;


class BannersRepository extends SqlRepository implements BannersRepoInterface
{
    private $factory;
    public $bannerSociety ="";
    public $bannerSizes ="";
    public $bannerPages ="";
    public function __construct()
    {
         $this->factory = new BannersFactory();
        $this->bannerSocietyFactory = new BannersSocietiesFactory();
        $this->bannerSizesFactory = new BannersSizesFactory();
        $this->bannerPagesFactory = new BannersPagesFactory();

    }
    public function delete($bannerId)
    {
        return $this->factory->delete($bannerId);
    }
    public function getPageBanners($params)
    {
        return $this->factory->getPageBanners($params);
    }
    public function getBanner($bannerId)
    {
        return $this->factory->find($bannerId);
    }
    public function getAllBanners($params)
    {
        return $this->factory->getAllBanners($params);
    }
    public function bannerCount()
    {
        return $this->factory->bannerCount();
    }
    public function getBanners($params)
    {
        return $this->factory->getBanners($params);
    }
    public function saveBanner(Banner $banner)
    {
        return $this->factory->store($banner);
    }
    public function saveSocieties( $societies,$bannerId)
    {
        return $this->bannerSocietyFactory->saveSocieties( $societies,$bannerId);
    }
    public function saveBannerSizes($bannerId,$area,$unit)
    {
        return $this->bannerSizesFactory->saveBannerSizes($bannerId,$area,$unit);
    }
    public function updateBanner(Banner $banner)
    {
        $this->factory->updateBanner($banner);
    }
    public function saveBannerPages($bannerId,$pageIds)
    {
        return $this->bannerPagesFactory->saveBannerPages($bannerId,$pageIds);
    }
}