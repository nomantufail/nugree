<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 10:55 AM
 */

namespace App\Transformers\Request\Society;
use App\Transformers\Request\RequestTransformer;

class GetSocietyMapsTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'societyId'=>$this->request->input('societyId')
        ];
    }
}