<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:46 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Role;

use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\User\MembershipPlanJsonPrototype;

class RoleJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id = null;
    public $name = "";
}