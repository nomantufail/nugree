<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Response;


class PropertyTransformer extends ResponseTransformer{

    public function transform($data){
        return [
            'P_t'=>$data['P_title'],
            'p_p'=>$data['p_price'],
            'p_s'=>$data['p_size'],
        ];
    }
} 