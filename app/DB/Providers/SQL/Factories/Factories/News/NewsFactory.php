<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\News;

use App\DB\Providers\SQL\Factories\Factories\News\Gateways\NewsQueryBuilder;
use App\DB\Providers\SQL\Factories\Factories\NewsImages\NewsImagesFactory;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\News;
use App\DB\Providers\SQL\Models\NewsDetail;


class NewsFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public $bannerDetail = null;
    public $newsImages = null;

    public function __construct()
    {
        $this->model = new News();
        $this->tableGateway = new NewsQueryBuilder();
        $this->newsImages = new NewsImagesFactory();
    }

    public function addNews(News $news)
    {
        return $this->tableGateway->insert($this->mapNewsOnTable($news));
    }
    public function all()
    {
        return $this->tableGateway->all();
    }
    public function getAllNews($params =[])
    {
        $final =[];
        $newses = $this->tableGateway->getAllNews($params);
        foreach($newses as $news)
        {
            $final[] = $this->mapDetail($news);
        }
        return $final;
    }
    public function NewsCount()
    {
        return $this->tableGateway->NewsCount();
    }
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function updateNews(News $news)
    {
        return $this->tableGateway->updateWhere(['id'=>$news->id],$this->mapNewsOnTable($news));
    }

    public function deleteNews($newsId)
    {
        return $this->tableGateway->delete($newsId);
    }
    public function getNews($newsId)
    {
        return $this->map($this->tableGateway->find($newsId));
    }
    public function getNewsDetail($newsId)
    {
        return $this->mapDetail($this->tableGateway->find($newsId));
    }
    public function map($result)
    {
        $news = clone($this->model);
        $news->id = $result->id;
        $news->title = $result->title;
        $news->description = $result->description;
        $news->createdAt = $result->created_at;
        $news->updatedAt = $result->updated_at;
        return $news;
    }
    public function getRecentNews()
    {
        return $this->mapCollection($this->tableGateway->getRecentNews());
    }
    public function mapDetail($result)
    {
        $news = new NewsDetail();
        $news->id = $result->id;
        $news->title = $result->title;
        $news->description = $result->description;
        $news->images = $this->newsImages->getNewsImages($result->id);
        return $news;
    }

    private function mapNewsOnTable(News $news)
    {
        return [
            'title'     => $news->title,
            'description'=> $news->description,
            'created_at'=> $news->createdAt,
        ];
    }
}