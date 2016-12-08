<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\BannersSizes\BannersSizesFactory;
use App\Libs\Helpers\LandArea;
use App\Repositories\Interfaces\Repositories\BannersRepoInterface;


class BannersSizesRepository extends SqlRepository implements BannersRepoInterface
{
    private $factory;
    public $bannerSociety ="";
    public $bannerSizes ="";
    public $bannerPages ="";
    public function __construct()
    {
        $this->factory = new BannersSizesFactory();

    }
    public function deleteBannerSize($bannerId)
    {
        return $this->factory->deleteBannerSize($bannerId);
    }
    public function getByBanner($bannerId)
    {
        $bannerSizes =  $this->factory->getByBanner($bannerId);
        $final =[];
        foreach($bannerSizes as $size)
        {
            $final[] =LandArea::convert('square feet',$size->unit,$size->area);
        }
        $unit = $this->getUnit($bannerSizes);
        return [
            'area'=>$final,
            'unit'=>$unit
        ];
    }
    public function getUnit($bannerSizes)
    {
        $final=[];
        foreach($bannerSizes as $size)
        {
            $final[] =$size->unit;
        }
        return $final;
    }
}