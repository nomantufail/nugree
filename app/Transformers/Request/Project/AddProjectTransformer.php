<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Project;


use App\Transformers\Request\RequestTransformer;


class AddProjectTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'images'=>$this->request->file('fileToUpload'),
            'description'=>$this->request->input('description'),
            'title'=>$this->request->input('title'),
            'societyId'=>$this->request->input('society_id'),
            'cityId'=>$this->request->input('city_id'),
        ];
    }
}