<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class SearchUsersTransformer extends RequestTransformer{

    public function transform(){
        return [
            'userRole'=>$this->request->input('user_role'),
            'location'=>$this->request->input('location'),
            'agencyName'=>$this->request->input('agency_name'),
            'page' => $this->request->input('page'),
            'limit' => $this->request->input('limit'),
        ];
    }
} 