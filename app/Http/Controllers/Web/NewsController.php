<?php

namespace App\Http\Controllers\Web;

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

    public function getNewsDetail(GetNewsRequest $request)
    {
        return $this->response->setView('frontend.v1.news_detail')->respond(['data'=>[
            'news'=>$this->newsRepo->getNewsDetail($request->get('newsId')),
            'recentNews'=>$this->newsRepo->getRecentNews()
        ]]);
    }

}
