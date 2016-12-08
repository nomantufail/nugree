<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/17/2016
 * Time: 12:17 PM
 */

namespace App\Libs\Auth\Traits;


trait TokenGenerator
{
    public function generateToken($keys = null)
    {
        $keyString = date('Y-m-d h:i:s');
        if($keys != null)
            if(is_array($keys))
                $keyString = join('-', $keys);
            else
                $keyString = $keys;

        return bcrypt($keyString);
    }
}