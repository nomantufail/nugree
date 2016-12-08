<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Type;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyType;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Type\PropertyParentTypeJsonPrototype;

class PropertyParentTypeJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(PropertyType $propertyType = null)
    {
        $this->model = $propertyType;
        $this->prototype = new PropertyParentTypeJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->name = $this->model->name;

        return $this->prototype;
    }

}