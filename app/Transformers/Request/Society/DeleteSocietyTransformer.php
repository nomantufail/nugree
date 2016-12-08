<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/8/2016
 * Time: 10:27 AM
 */

namespace App\Transformers\Request\Society
;
use App\Transformers\Request\RequestTransformer;

class DeleteSocietyTransformer extends  RequestTransformer
{
    public function transform()
    {
        return [
                'id'=>$this->request->input('society_id'),
        ];
    }
}