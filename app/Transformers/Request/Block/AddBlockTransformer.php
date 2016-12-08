<?php
namespace App\Transformers\Request\Block;

use App\Transformers\Request\RequestTransformer;

class AddBlockTransformer extends RequestTransformer
{
 public function transform()
 {
     return [
         'societyId'=>$this->request->input('society_id'),
         'block'=>$this->request->input('block_name')
     ];
 }
}