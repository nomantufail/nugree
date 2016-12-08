<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Response;


use App\DB\Providers\SQL\Models\City;

class CityTransformer extends ResponseTransformer{

    public function transform($country)
    {
        return $country;
    }

    public function transformDocument(City $city)
    {
        return $city;
    }
} 