<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\BannersSizes;

use App\DB\Providers\SQL\Factories\Factories\BannersSizes\Gateways\BannersSizesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\BannerSize;
use App\Libs\Helpers\LandArea;


class BannersSizesFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new BannerSize();
        $this->tableGateway = new BannersSizesQueryBuilder();
    }
    public function deleteBannerSize($bannerId)
    {
        return $this->tableGateway->deleteWhere(['banner_id'=>$bannerId]);
    }
    public function getByBanner($bannerId)
    {
        return $this->tableGateway->getByBanner($bannerId);
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
    public function saveBannerSizes($bannerId,$area,$unit)
    {
        $finalRecord = [];
        foreach($area as $key=>$value)
        {
            $finalRecord[] = ['banner_id'=>$bannerId,'area'=>LandArea::convert($unit,'square feet',$value),'unit'=>$unit,'created_at' =>date('Y-m-d h:i:s')];
        }
        return $this->tableGateway->insertMultiple($finalRecord);
    }
    public function store(BannerSize $bannerSize)
    {
        $bannerSize->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapBlockOnTable($bannerSize));
    }

    public function map($result)
    {
        $bannerSize = clone($this->model);
        $bannerSize->id = $result->id;
        $bannerSize->bannerId = $result->banner_id;
        $bannerSize->area = $result->area;
        $bannerSize->unit = $result->unit;
        $bannerSize->createdAt = $result->created_at;
        $bannerSize->updatedAt = $result->updated_at;
        return $bannerSize;
    }
    private function mapBlockOnTable(BannerSize $bannerSize)
    {
        return [
            'banner_id'=> $bannerSize->bannerId,
            'area'=> $bannerSize->area,
            'unit'=> $bannerSize->unit,

            'updated_at'=> $bannerSize->createdAt,
        ];
    }
}