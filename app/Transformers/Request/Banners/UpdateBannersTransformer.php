<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Banners;


use App\Transformers\Request\RequestTransformer;


class UpdateBannersTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id'=>$this->request->get('banner_id'),
            'bannerImage'=>$this->request->file('fileToUpload'),
            'societiesIds'=>$this->request->input('society_id'),
            'pagesIds'=>$this->request->input('pages'),
            'area'=>$this->request->input('area'),
            'unit'=>$this->request->input('unit'),
            'position'=>$this->request->input('position'),
            'type'=>$this->request->input('type'),
            'priority'=>$this->request->input('priority'),
            'bannerLink'=>$this->request->input('banner_link'),
        ];
    }
}