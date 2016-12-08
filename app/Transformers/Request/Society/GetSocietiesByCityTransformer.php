<?php
namespace App\Transformers\Request\Society;

use App\Transformers\Request\RequestTransformer;

class GetSocietiesByCityTransformer extends RequestTransformer
{
 public function transform()
  {
     return [
         'cityId'=>$this->request->input('city_id'),
     ];
  }
}