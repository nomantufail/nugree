<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class ForgetPasswordTransformer extends RequestTransformer{

    public function transform(){
        return [
            'email' => $this->request->get('email')
        ];
    }
}