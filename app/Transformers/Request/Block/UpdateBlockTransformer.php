<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/8/2016
 * Time: 10:27 AM
 */

namespace App\Transformers\Request\Block;


use App\Transformers\Request\RequestTransformer;

class UpdateBlockTransformer extends RequestTransformer
{
    public function transform()
    {

        return [
                'id'=>$this->request->input('block_id'),
                'societyId'=>$this->request->input('society_id'),
                'block'=>$this->request->input('block_name')
        ];
    }
}