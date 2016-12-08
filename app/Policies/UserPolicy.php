<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/22/2016
 * Time: 12:39 PM
 */

namespace App\Policies;

use App\DB\Providers\SQL\Models\User;

class UserPolicy extends Policy
{
    public function update(User $user ,User $subject=null)
    {
        if($user->id == $subject->id)
        {
            return true;
        }
        return false;
    }

}