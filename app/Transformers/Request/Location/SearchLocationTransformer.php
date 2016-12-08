<?php
namespace App\Transformers\Request\Location;

use App\Transformers\Request\RequestTransformer;

class SearchLocationTransformer extends RequestTransformer
{
 public function transform()
  {
     return [
         'cityId'=>$this->request->input('cityId'),
         'keyword'=>$this->request->input('keyword'),
     ];
  }
}