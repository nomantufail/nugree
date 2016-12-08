<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request;


class UpdatePropertyTransformer extends RequestTransformer{

    public function transform($data){
        return [
            'P_title'=>$data['title'],
            'p_price'=>$data['price'],
            'p_size'=>$data['size'],
        ];
    }
} 