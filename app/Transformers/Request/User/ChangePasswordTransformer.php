<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class ChangePasswordTransformer extends RequestTransformer{

    public function transform(){
        return [
            'userId' => $this->request->input('userId'),
            'existingPassword' => $this->request->input('existingPassword'),
            'newPassword' => $this->request->input("newPassword")
        ];
    }
} 