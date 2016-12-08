<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\PropertyDocument;


use App\Transformers\Request\RequestTransformer;


class AddPropertyDocumentTransformer extends RequestTransformer
{
 public function transform()
 {
     return [
         'propertyId'=>$this->request->input('property_id'),
         'type'=>$this->request->input('type'),
         'path'=>$this->request->input('path'),
         'title'=>$this->request->input('title'),
    ];
 }
}