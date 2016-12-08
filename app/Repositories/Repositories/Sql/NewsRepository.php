<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\News\NewsFactory;
use App\DB\Providers\SQL\Factories\Factories\NewsImages\NewsImagesFactory;
use App\DB\Providers\SQL\Models\News;
use App\Repositories\Interfaces\Repositories\NewsRepoInterface;


class NewsRepository extends SqlRepository implements NewsRepoInterface
{
    private $factory;
    private $newsImagesFactory;
    public function __construct()
    {
         $this->factory = new NewsFactory();
        $this->newsImagesFactory = new NewsImagesFactory();
    }
    public function addNews(News $news)
    {
        return $this->factory->addNews($news);
    }
    public function addImages($images,$newsId)
    {
        return $this->newsImagesFactory->addImages($images,$newsId);
    }
    public function getAllNews($params =[])
    {
        return $this->factory->getAllNews($params);
    }
    public function newsCount()
    {
        return $this->factory->NewsCount();
    }
    public function deleteNews($projectId)
    {
        return $this->factory->deleteNews($projectId);
    }
    public function getNews($projectId)
    {
        return $this->factory->getNews($projectId);
    }
    public function getNewsDetail($newsId)
    {
        return $this->factory->getNewsDetail($newsId);
    }
    public function getRecentNews()
    {
        return $this->factory->getRecentNews();
    }
    public function getNewsImages($projectId)
    {
        return $this->newsImagesFactory->getNewsImages($projectId);
    }
    public function  updateNews(News $news)
    {
        return $this->factory->updateNews($news);
    }
    public function deleteNewsImages($projectId)
    {
        return $this->newsImagesFactory->deleteNewsImages($projectId);
    }
    public function deleteNewsImage($imageId)
    {
        return $this->newsImagesFactory->deleteNewsImage($imageId);
    }
}