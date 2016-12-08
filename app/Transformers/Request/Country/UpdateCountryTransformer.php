<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 9:17 AM
 */

namespace App\Transformers\Request\Country;


use App\Transformers\Request\RequestTransformer;

class UpdateCountryTransformer extends RequestTransformer
{
  public function transform()
  {
      return[
          'id'=>$this->request->input('country_id'),
          'country'=>$this->request->input('country_name')
      ];
  }
}