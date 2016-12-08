<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Role;


use App\Transformers\Request\RequestTransformer;


class AddRoleTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'roleName'=>$this->request->input('role_name'),
        ];
    }
}