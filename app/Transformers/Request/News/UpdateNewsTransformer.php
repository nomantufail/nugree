<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\News;


use App\Transformers\Request\RequestTransformer;


class UpdateNewsTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'newsId'=>$this->request->input('news_id'),
            'images'=>$this->request->file('fileToUpload'),
            'description'=>$this->request->input('description'),
            'title'=>$this->request->input('title'),
        ];
    }
}