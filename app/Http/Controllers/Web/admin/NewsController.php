<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Requests\News\AddNewsRequest;
use App\Http\Requests\Requests\News\DeleteNewsImageRequest;
use App\Http\Requests\Requests\News\DeleteNewsRequest;
use App\Http\Requests\Requests\News\GetAllNewsRequest;
use App\Http\Requests\Requests\News\GetNewsImagesRequest;
use App\Http\Requests\Requests\News\GetNewsRequest;
use App\Http\Requests\Requests\News\UpdateNewsRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\NewsRepoProvider;


class NewsController extends Controller
{
    public $response = null;
    public $newsRepo = null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->newsRepo = (new NewsRepoProvider())->repo();
    }
    public function News()
    {
        return $this->response->setView('admin.news.news')->respond([
        ]);
    }
    public function addNews(AddNewsRequest $request)
    {
        $newsId = $this->newsRepo->addNews($request->getNewsModel());

        if($request->get('images')[0] !=null)
         $this->addNewsImages($request,$newsId);
        return redirect('maliksajidawan786@gmail.com/news/listing');
    }
    public function addNewsImages(AddNewsRequest $request ,$newsId)
    {
        return $this->newsRepo->addImages($request->getNewsImageModel(),$newsId);
    }
    public function getAllNews(GetAllNewsRequest $request)
    {
        return $this->response->setView('admin.news.news-listing')->respond(['data'=>[
            'news'=>$this->newsRepo->getAllNews($request->all()),
            'newsCount'=>($this->newsRepo->NewsCount()[0]->total_records)
        ]]);
    }
    public function deleteNews(DeleteNewsRequest $request)
    {
        $this->newsRepo->deleteNews($request->get('newsId'));
        return redirect('maliksajidawan786@gmail.com/news/listing');
    }
    public function getNews(GetNewsRequest $request)
    {
        return $this->response->setView('admin.news.update-news')->respond(['data'=>[
            'news'=>$this->newsRepo->getNews($request->get('newsId')),
         ]]);
    }

    public function updateNews(UpdateNewsRequest $request)
    {
        $this->newsRepo->updateNews($request->getNewsModel());
        if(($request->get('images')[0]) !=null && ($request->get('images')[0]) !="")
            $this->newsRepo->addImages($request->getNewsImageModel(),$request->get('newsId'));
        return redirect('maliksajidawan786@gmail.com/news/listing');
    }
    public function getNewsImages(GetNewsImagesRequest $request)
    {
        return $this->response->setView('admin.news.images-listing')->respond(['data'=>[
            'newsImage'=>$this->newsRepo->getNewsImages($request->get('newsId'))
        ]]);
    }
    public function deleteNewsImage(DeleteNewsImageRequest $request)
    {
        $this->newsRepo->deleteNewsImage($request->get('imageId'));
        return redirect('maliksajidawan786@gmail.com/get/news/images');
    }
}
