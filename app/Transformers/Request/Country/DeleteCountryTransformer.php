<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 10:27 AM
 */

namespace App\Transformers\Request\Country;


use App\Transformers\Request\RequestTransformer;

class DeleteCountryTransformer extends RequestTransformer
{
  public function transform()
  {
      return[
          'id'=>$this->request->input('country_id')
      ];
  }
}