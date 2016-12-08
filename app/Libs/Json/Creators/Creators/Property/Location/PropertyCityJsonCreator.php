<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Location;

use App\DB\Providers\SQL\Models\Block;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Society;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertyCityJsonPrototype;

class PropertyCityJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(City $society = null)
    {
        $this->model = $society;
        $this->prototype = new PropertyCityJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->name = $this->model->name;
        $this->prototype->slug = $this->model->slug;
        return $this->prototype;
    }
}