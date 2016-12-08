<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property;

use App\DB\Providers\SQL\Models\PropertyPurpose;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyPurposeJsonPrototype;

class PropertyPurposeJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(PropertyPurpose $propertyPurpose = null)
    {
        $this->model = $propertyPurpose;
        $this->prototype = new PropertyPurposeJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->name = $this->model->name;
        return $this->prototype;
    }
}