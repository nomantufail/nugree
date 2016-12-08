<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Agency;


use App\Transformers\Request\RequestTransformer;


class DeleteAgencyTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id' =>$this->request->input('agency_id'),
        ];
    }
}