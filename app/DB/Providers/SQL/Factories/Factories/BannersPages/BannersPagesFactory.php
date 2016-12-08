<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\BannersPages;

use App\DB\Providers\SQL\Factories\Factories\BannersPages\Gateways\BannersPagesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\BannerPages;


class BannersPagesFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new BannerPages();
        $this->tableGateway = new BannersPagesQueryBuilder();
    }
    public function getByBannerId($bannerId)
    {
        return $this->tableGateway->getByBannerId($bannerId);
    }
    public function deleteBannerPages($bannerId)
    {
        return $this->tableGateway->deleteWhere(['banner_id'=>$bannerId]);
    }
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }


    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function saveBannerPages($bannerId,$pageIds)
    {
        $finalRecord = [];
        foreach($pageIds as $key=>$value)
        {
          $finalRecord[] = ['banner_id'=>$bannerId,'page_id'=>$value,'created_at' =>date('Y-m-d h:i:s')];
        }
        return $this->tableGateway->insertMultiple($finalRecord);
    }
    public function store(BannerPages $bannerPages)
    {
        $bannerPages->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapBlockOnTable($bannerPages));
    }

    public function map($result)
    {
        $bannerPages = clone($this->model);
        $bannerPages->id = $result->id;
        $bannerPages->bannerId = $result->banner_id;
        $bannerPages->pageId = $result->area;

        $bannerPages->createdAt = $result->created_at;
        $bannerPages->updatedAt = $result->updated_at;
        return $bannerPages;
    }
    private function mapBlockOnTable(BannerPages $bannerPages)
    {
        return [
            'banner_id'=> $bannerPages->bannerId,
            'page_id'=> $bannerPages->pageId,


            'updated_at'=> $bannerPages->createdAt,
        ];
    }
}