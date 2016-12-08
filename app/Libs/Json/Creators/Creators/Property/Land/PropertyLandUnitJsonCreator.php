<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Land;

use App\DB\Providers\SQL\Models\LandUnit;
use App\DB\Providers\SQL\Models\Property;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Land\PropertyLandUnitJsonPrototype;

class PropertyLandUnitJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(LandUnit $landUnit = null)
    {
        $this->model = $landUnit;
        $this->prototype = new PropertyLandUnitJsonPrototype();
    }

    public function create()
    {
        $model = clone($this->model);
        $this->prototype->id = $model->id;
        $this->prototype->name = $model->name;
        return $this->prototype;
    }

}