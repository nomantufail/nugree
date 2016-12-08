<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\NewsImages;
use App\DB\Providers\SQL\Factories\Factories\NewsImages\Gateways\NewsImagesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\NewsImages;


class NewsImagesFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public $bannerDetail = null;

    public function __construct()
    {
        $this->model = new NewsImages();
        $this->tableGateway = new NewsImagesQueryBuilder();
    }

    public function addImages($images,$newsId)
    {
        $final=[];
        foreach($images as $image)
        {
            $final[] = ['news_id'=>$newsId,'image'=>$image];
        }
       return $this->tableGateway->insertMultiple($final);
    }
    public function addNews(NewsImages $newsImages)
    {
        return $this->tableGateway->insert($this->mapNewsOnTable($newsImages));
    }
    public function all()
    {
        return $this->tableGateway->all();
    }


    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function deleteNewsImage($imageId)
    {
        return $this->tableGateway->deleteWhere(['id'=>$imageId]);
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }

    public function deleteNewsImages($newsId)
    {
        return $this->tableGateway->deleteWhere(['news_id'=>$newsId]);
    }
    public function map($result)
    {
        $newsImage = clone($this->model);
        $newsImage->id = $result->id;
        $newsImage->image = $result->image;
        $newsImage->newsId = $result->news_id;
        $newsImage->createdAt = $result->created_at;
        $newsImage->updatedAt = $result->updated_at;
        return $newsImage;
    }

    private function mapNewsOnTable(NewsImages $bannerImage)
    {
        return [
            'image'=> $bannerImage->image,
            'news_id'=> $bannerImage->newsId,
        ];
    }
    public function getNewsImages($newsId)
    {
        return $this->mapCollection($this->tableGateway->getWhere(['news_id'=>$newsId]));
    }
}