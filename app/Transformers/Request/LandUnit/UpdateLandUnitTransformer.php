<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\LandUnit;


use App\Transformers\Request\RequestTransformer;


class UpdateLandUnitTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id' =>$this->request->input('land_unit_id'),
            'landUnit'=>$this->request->input('land_unit_name'),
        ];
    }
}