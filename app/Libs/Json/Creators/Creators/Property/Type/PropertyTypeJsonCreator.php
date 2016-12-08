<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Type;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\Property\PropertyCompleteType;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Type\PropertyTypeJsonPrototype;

class PropertyTypeJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(PropertyCompleteType $propertyType = null)
    {
        $this->model = $propertyType;
        $this->prototype = new PropertyTypeJsonPrototype();
    }

    public function create()
    {
        $this->prototype->parentType = $this->getParentType();
        $this->prototype->subType = $this->getSubType();

        return $this->prototype;
    }

    private function getParentType()
    {
        return (new PropertyParentTypeJsonCreator($this->model->parentType))->create();
    }

    private function getSubType()
    {
        return (new PropertySubTypeJsonCreator($this->model->subType))->create();
    }

}