<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 9:17 AM
 */

namespace App\Transformers\Request\PropertyDocuments;


use App\Transformers\Request\RequestTransformer;

class UpdatePropertyDocumentTransformer extends RequestTransformer
{
  public function transform()
  {
      return[
          'id'=>$this->request->input('document_id'),
          'propertyId'=>$this->request->input('property_id'),
          'type'=>$this->request->input('type'),
          'path'=>$this->request->input('path'),
          'title'=>$this->request->input('title'),

      ];
  }
}