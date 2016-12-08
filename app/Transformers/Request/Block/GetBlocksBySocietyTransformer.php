<?php
namespace App\Transformers\Request\Block;

use App\Transformers\Request\RequestTransformer;

class GetBlocksBySocietyTransformer extends RequestTransformer
{
 public function transform()
 {
     return [
         'societyId'=>$this->request->input('society_id'),

     ];
 }
}