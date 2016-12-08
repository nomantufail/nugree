<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class GetAdminAgentsTransformer extends RequestTransformer{

    public function transform(){
        return [
            'userId' => $this->request->get('userId')
        ];
    }
} 