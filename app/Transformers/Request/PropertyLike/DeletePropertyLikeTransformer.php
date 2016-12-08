<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\PropertyLike;

use App\Transformers\Request\RequestTransformer;

class DeletePropertyLikeTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id'=>$this->request->input('property_like_id'),
        ];
    }
}