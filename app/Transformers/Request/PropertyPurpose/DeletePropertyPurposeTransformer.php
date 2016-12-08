<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/8/2016
 * Time: 10:27 AM
 */

namespace App\Transformers\Request\PropertyPurpose;
use App\Transformers\Request\RequestTransformer;

class DeletePropertyPurposeTransformer extends  RequestTransformer
{
    public function transform()
    {
        return [
                'id'=>$this->request->input('purpose_id'),
        ];
    }
}