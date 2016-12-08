<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Location;

use App\DB\Providers\SQL\Models\Block;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertyBlockJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertySubLocationJsonPrototype;

class PropertyBlockJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(Block $block = null)
    {
        $this->model = $block;
        $this->prototype = new PropertySubLocationJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->location = $this->model->name;
        $this->prototype->cityId = $this->model->name;
        $this->prototype->lat= $this->model->name;
        $this->prototype->long = $this->model->name;

        return $this->prototype;
    }
}