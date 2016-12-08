<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\News;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\NewsValidators\UpdateNewsValidator;
use App\Repositories\Providers\Providers\NewsRepoProvider;
use App\Transformers\Request\News\UpdateNewsTransformer;


class UpdateNewsRequest extends Request implements RequestInterface{

    public $validator;
    public $newsRepo;

    public function __construct(){
        parent::__construct(new UpdateNewsTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateNewsValidator($this);
        $this->newsRepo = (new NewsRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
    public function getNewsModel()
    {
        $news = $this->newsRepo->getNews($this->get('newsId'));
        $news->id = $this->get('newsId');
        $news->title = $this->get('title');
        $news->description = $this->get('description');
        return $news;
    }
    public function getNewsImageModel()
    {
        $final = [];
        $newsRepoImages = $this->get('images');

        if($newsRepoImages[0] !=null && $newsRepoImages !="")
        foreach($newsRepoImages as $image)
        {
            $extension = $image->getClientOriginalExtension();
            $imageName = md5($image->getClientOriginalName()) . '.' . $extension;
            $image->move(public_path() . '/assets/imgs/projects', $imageName);
            $final[] = 'assets/imgs/projects/' . $imageName;
        }
        return $final;
    }

} 