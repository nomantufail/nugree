<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\JoinUs;


use App\Transformers\Request\RequestTransformer;


class AddJoinUsTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'email'=> $this->request->input('email'),
            'name'=> $this->request->input('name'),
            'phone'=> $this->request->input('phone'),
            'message'=> $this->request->input('message'),
            'purpose'=> $this->request->input('purpose'),
            'address'=> $this->request->input('address'),
         ];
    }
}