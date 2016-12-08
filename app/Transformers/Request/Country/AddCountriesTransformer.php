<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Country;


use App\Transformers\Request\RequestTransformer;


class AddCountriesTransformer extends RequestTransformer
{
 public function transform()
 {
     return [
         'country'=>$this->request->input('country_name')
     ];
 }
}