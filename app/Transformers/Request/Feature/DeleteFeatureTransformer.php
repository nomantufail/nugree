<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/16/2016
 * Time: 9:48 AM
 */

namespace App\Transformers\Request\Feature;


use App\Transformers\Request\RequestTransformer;

class DeleteFeatureTransformer extends RequestTransformer
{
   public function transform()
   {
       return [
           'featureId'=>$this->request->input('feature_id'),
       ];
   }
}