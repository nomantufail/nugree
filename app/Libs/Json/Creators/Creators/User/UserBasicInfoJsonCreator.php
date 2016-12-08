<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\User;

use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\User\UserBasicInfoJsonPrototype;
use App\DB\Providers\SQL\Models\User;

class UserBasicInfoJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
        $this->prototype = new UserBasicInfoJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->email = $this->model->email;
        $this->prototype->fName = $this->model->fName;
        $this->prototype->lName = $this->model->lName;
        $this->prototype->phone = $this->model->phone;
        $this->prototype->mobile = $this->model->mobile;
        $this->prototype->fax = $this->model->fax;
        $this->prototype->address = $this->model->address;
        $this->prototype->zipCode = $this->model->zipCode;

        return $this->prototype;
    }
}