<?php
namespace App\Transformers\Request\PropertyPurpose;
use App\Transformers\Request\RequestTransformer;
class AddPropertyPurposeTransformer extends RequestTransformer
{
 public function transform()
 {
     return [
         'purpose'=>$this->request->input('purpose_name')
     ];
 }
}