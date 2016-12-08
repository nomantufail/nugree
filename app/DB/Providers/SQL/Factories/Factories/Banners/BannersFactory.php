<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\Banners;

use App\DB\Providers\SQL\Factories\Factories\Banners\Gateways\BannersQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Banner;
use App\DB\Providers\SQL\Models\BannersDetail;

class BannersFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public  $bannerDetail =null;
    public function __construct()
    {
        $this->model = new Banner();
        $this->bannerDetail = new BannersDetail();
        $this->tableGateway = new BannersQueryBuilder();
    }

    public function getAllBanners($params)
    {
        $final =[];
        $Banners = $this->tableGateway->getAllBanners($params);
        foreach($Banners as $banner)
        {
            $final[] =$this->bannerDetail($banner);
        }
        return $final;
    }
    public function getPageBanners($params)
    {
        $Banners  = $this->tableGateway->getPageBanners($params);
        $final =[];
        foreach($Banners as $banner)
        {
            $final[] =$this->bannerDetail($banner);
        }
        return $final;
    }
    public function all()
    {
        $this->tableGateway->all();
    }
    public function delete($bannerId)
    {
        return $this->tableGateway->delete($bannerId);
    }
    public function bannerCount()
    {
        return $this->tableGateway->bannerCount();
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function getBanners($params)
    {
        return $this->tableGateway->getBanners($params);
//        $collection = collect($this->tableGateway->getBanners($params));
//        $bannerType = $collection->groupBy('banner_type');
//        $fixedBanners = (isset($bannerType['fix']))?$bannerType['fix']:[];
//        $groupedRelevantBanners = (isset($bannerType['relevant']))?$bannerType['relevant']->groupBy('position'):[];
//        return [
//            'fixBanners' => $fixedBanners,
//            'relevantBanners' =>$groupedRelevantBanners
//        ];
    }



    public function updateBanner(Banner $banner)
    {
        $this->tableGateway->updateWhere(['id'=>$banner->id],$this->mapBannerOnTable($banner));
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function store(Banner $banner)
    {
        $banner->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapBannerOnTable($banner));
    }

    public function map($result)
    {
        $banner = clone($this->model);
        $banner->id = $result->id;
        $banner->bannerLink = $result->banner_link;
        $banner->bannerPriority = $result->banner_priority;
        $banner->bannerType = $result->banner_type;
        $banner->image = $result->image;
        $banner->position = $result->position;
        $banner->createdAt = $result->created_at;
        $banner->updatedAt = $result->updated_at;
        return $banner;
    }
    public function bannerDetail($result)
    {
        $banner = clone($this->bannerDetail);
        $banner->id = $result->id;
        $banner->bannerLink = $result->banner_link;
        $banner->bannerPriority = $result->banner_priority;
        $banner->bannerType = $result->banner_type;
        $banner->image = $result->image;
        $banner->position = $result->position;
        $banner->page = $result->page;
        $banner->createdAt = $result->created_at;
        $banner->updatedAt = $result->updated_at;
        return $banner;
    }
    private function mapBannerOnTable(Banner $banner)
    {
        return [
            'position'     => $banner->position,
            'banner_type'=> $banner->bannerType,
            'image'=> $banner->image,
            'banner_priority'=> $banner->bannerPriority,
            'banner_link'=>$banner->bannerLink,
            'created_at'=> $banner->createdAt,
        ];
    }
}