<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Mail;


use App\Transformers\Request\RequestTransformer;


class MailToAgentTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'userId'=>$this->request->input('userId'),
            'propertyId'=>$this->request->input('propertyId'),
            'type'=>$this->request->input('type'),
            'email'=>$this->request->input('email'),
            'name'=>$this->request->input('name'),
            'phone'=>$this->request->input('phone'),
            'subject'=>$this->request->input('subject'),
            'message'=>$this->request->input('message'),
        ];
    }
}