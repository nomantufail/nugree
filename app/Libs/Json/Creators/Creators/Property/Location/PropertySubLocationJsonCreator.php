<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Location;

use App\DB\Providers\SQL\Models\Block;
use App\DB\Providers\SQL\Models\Location;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertyBlockJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertySubLocationJsonPrototype;

class PropertySubLocationJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(Location $location = null)
    {
        $this->model = $location;
        $this->prototype = new PropertySubLocationJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->location = $this->model->location;
        $this->prototype->cityId = $this->model->cityId;
        $this->prototype->lat = $this->model->lat;
        $this->prototype->long = $this->model->long;
        $this->prototype->slug = $this->model->slug;
        return $this->prototype;
    }
}