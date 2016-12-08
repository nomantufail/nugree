<?php
namespace App\Transformers\Request\Society;

use App\Transformers\Request\RequestTransformer;

class AddSocietyTransformer extends RequestTransformer
{
 public function transform()
 {
     return [

         'cityId'=>$this->request->input('city_id'),
         'priority'=>$this->request->input('priority'),
         'society'=>$this->request->input('society_name')
     ];
 }
    }