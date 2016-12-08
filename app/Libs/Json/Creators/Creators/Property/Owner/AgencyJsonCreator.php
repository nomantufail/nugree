<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Owner;

use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\DB\Providers\SQL\Models\Agency;
use App\Libs\Json\Prototypes\Prototypes\Property\Owner\PropertyAgencyJsonPrototype;

class AgencyJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(Agency $agency = null)
    {
        $this->model = $agency;
        $this->prototype = new PropertyAgencyJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->address = $this->model->address;
        $this->prototype->email = $this->model->email;
        $this->prototype->mobile = $this->model->mobile;
        $this->prototype->name = $this->model->name;
        $this->prototype->phone = $this->model->phone;
        $this->prototype->logo = $this->model->logo;
        $this->prototype->slug = $this->model->slug;

        return $this->prototype;
    }
}