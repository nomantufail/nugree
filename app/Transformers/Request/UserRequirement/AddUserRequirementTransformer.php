<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\UserRequirement;


use App\Transformers\Request\RequestTransformer;


class AddUserRequirementTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'email'=> $this->request->input('email'),
            'name'=> $this->request->input('name'),
            'phone'=> $this->request->input('phone'),
            'subject'=> $this->request->input('subject'),
            'requirement'=> $this->request->input('requirement'),
         ];
    }
}