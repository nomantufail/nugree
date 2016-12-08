<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Mail;


use App\Transformers\Request\RequestTransformer;


class FeedbackTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'type'=>$this->request->input('type'),
            'name'=>$this->request->input('name'),
            'email'=>$this->request->input('email'),
            'phone'=>$this->request->input('phone'),
            'subject'=>$this->request->input('subject'),
            'message'=>$this->request->input('message'),
        ];
    }
}