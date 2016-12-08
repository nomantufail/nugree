<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/22/2016
 * Time: 12:39 PM
 */

namespace App\Policies;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\User;

class PropertyPolicy extends Policy
{
    public function update(User $user ,Property $property=null)
    {
        if($user->id == $property->ownerId || $user->id == $property->createdBy)
        {
            return true;
        }
        return false;
    }
    public function delete(User $user ,Property $property=null)
    {
        if($user->id == $property->ownerId || $user->id == $property->createdBy)
        {
            return true;
        }
        return false;
    }

    public function forceDelete(User $user ,Property $property=null)
    {
        if($user->id == $property->ownerId || $user->id == $property->createdBy)
        {
            return true;
        }
        return false;
    }
}