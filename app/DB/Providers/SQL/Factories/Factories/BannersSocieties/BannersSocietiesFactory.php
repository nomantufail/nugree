<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\BannersSocieties;

use App\DB\Providers\SQL\Factories\Factories\BannersSocieties\Gateways\BannersSocietiesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Banner;
use App\DB\Providers\SQL\Models\BannerSocieties;
use App\DB\Providers\SQL\Models\Block;


class BannersSocietiesFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new BannerSocieties();
        $this->tableGateway = new BannersSocietiesQueryBuilder();
    }

    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function getByBanner($bannerId)
    {
        return $this->tableGateway->getByBanner($bannerId);
    }
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function deleteBannerSocieties($bannerId)
    {
        return $this->tableGateway->deleteWhere(['banner_id'=>$bannerId]);
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
    public function saveSocieties($societies,$bannerId)
    {
        $finalRecord = [];

        foreach($societies as $key=>$value)
        {
            $finalRecord[] = ['banner_id'=>$bannerId,'location_id'=>$value,'created_at' =>date('Y-m-d h:i:s')];
        }
        return $this->tableGateway->insertMultiple($finalRecord);
    }
    public function store(BannerSocieties $bannerSocieties)
    {
        $bannerSocieties->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapBlockOnTable($bannerSocieties));
    }

    public function map($result)
    {
        $bannerSocieties = clone($this->model);
        $bannerSocieties->id = $result->id;
        $bannerSocieties->bannerId = $result->banner_id;
        $bannerSocieties->societyId = $result->society_id;
        $bannerSocieties->createdAt = $result->created_at;
        $bannerSocieties->updatedAt = $result->updated_at;
        return $bannerSocieties;
    }
    private function mapBlockOnTable(BannerSocieties $bannerSocieties)
    {
        return [
            'banner_id'  => $bannerSocieties->bannerId,
            'society_id'=> $bannerSocieties->societyId,

            'updated_at'=> $bannerSocieties->createdAt,
        ];
    }
}