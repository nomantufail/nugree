<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Mail;


use App\Transformers\Request\RequestTransformer;


class MailPropertyToFriendTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'to'=>$this->request->input('to'),
            'message'=>$this->request->input('message'),
        ];
    }
}