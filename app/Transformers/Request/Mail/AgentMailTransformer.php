<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Mail;


use App\Transformers\Request\RequestTransformer;


class AgentMailTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'name'=>$this->request->input('name'),
            'to'=>$this->request->input('to'),
            'email'=>$this->request->input('email'),
            'cell'=>$this->request->input('cell'),
            'message'=>$this->request->input('message'),
        ];
    }
}