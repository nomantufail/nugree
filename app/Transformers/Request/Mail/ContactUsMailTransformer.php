<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Mail;


use App\Transformers\Request\RequestTransformer;


class ContactUsMailTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'email'=>$this->request->input('email'),
            'name'=>$this->request->input('name'),
            'subject'=>$this->request->input('subject'),
            'message'=>$this->request->input('message'),
        ];
    }
}