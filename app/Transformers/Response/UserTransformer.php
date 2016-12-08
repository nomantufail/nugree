<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Response;


class UserTransformer extends ResponseTransformer{

    public function transform($user)
    {
        return $user;
    }

    public function transformDocument($userObject)
    {
        return $userObject;
    }
} 