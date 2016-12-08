<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 11:07 AM
 */

namespace App\Repositories\Transformers\Elastic;

use App\Repositories\Interfaces\Transformers\RepositoryTransformerInterface;

class UserTransformer extends ElasticTransformer implements RepositoryTransformerInterface
{
    public function transform($user)
    {
        return [
            'f_name' => $user->f_name,
            'l_name' => $user->l_name,
            'email' => $user->email
        ];
    }
}