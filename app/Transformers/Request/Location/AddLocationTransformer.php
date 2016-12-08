<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Location;


use App\Transformers\Request\RequestTransformer;


class AddLocationTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'cityId'=>$this->request->input('city_id'),
            'location'=>$this->request->input('location'),
            'path'=>$this->request->input('path'),
            'lat'=>$this->request->input('lat'),
            'long'=>$this->request->input('long'),
        ];
    }
}