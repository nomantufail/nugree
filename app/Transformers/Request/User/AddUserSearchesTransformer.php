<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class AddUserSearchesTransformer extends RequestTransformer{

    public function transform(){
        return [
            'searchedParams'=>$this->request->input('searched_params'),
            'email'=>$this->request->input('email'),
            'mobile'=>$this->request->input('mobile'),
        ];
    }
} 