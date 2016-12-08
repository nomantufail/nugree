<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\City;


use App\Transformers\Request\RequestTransformer;


class AddCityTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'name'=>$this->request->input('city_name'),
            'countryId' => $this->request->input('country_id'),
            'priority' => $this->request->input('priority'),
            'file' => $this->request->file('fileToUpload')
        ];
    }
}