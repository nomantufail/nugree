<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/8/2016
 * Time: 10:27 AM
 */

namespace App\Transformers\Request\Society;


use App\Transformers\Request\RequestTransformer;

class GetUpdateSocietyFormTransformer extends RequestTransformer
{
    /**
     * @return array
     */
    public function transform()
    {
        return [
                'societyId'=>$this->request->input('society_id'),

        ];
    }
}