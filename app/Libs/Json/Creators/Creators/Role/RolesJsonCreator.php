<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Role;

use App\DB\Providers\SQL\Models\Role;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Role\RoleJsonPrototype;

class RolesJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(Role $role = null)
    {
        $this->model = $role;
        $this->prototype = new RoleJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->name = $this->model->name;
        return $this->prototype;
    }
}