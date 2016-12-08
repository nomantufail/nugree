<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property;

use App\DB\Providers\SQL\Models\PropertyStatus;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyStatusJsonPrototype;

class PropertyStatusJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(PropertyStatus $status = null)
    {
        $this->model = $status;
        $this->prototype = new PropertyStatusJsonPrototype();
    }

    public function create()
    {
        $model = clone($this->model);

        $this->prototype->id = $model->id;
        $this->prototype->name = $model->name;

        return $this->prototype;
    }

}