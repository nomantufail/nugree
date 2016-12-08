<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Mail;


use App\Transformers\Request\RequestTransformer;


class WantedMailTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'name'=>$this->request->input('name'),
            'email'=>$this->request->input('email'),
            'phone'=>$this->request->input('phone'),
            'requirements'=>$this->request->input('requirements'),
        ];
    }
}