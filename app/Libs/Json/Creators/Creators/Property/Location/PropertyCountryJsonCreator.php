<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Location;

use App\DB\Providers\SQL\Models\Block;
use App\DB\Providers\SQL\Models\Country;
use App\DB\Providers\SQL\Models\Society;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertyCountryJsonPrototype;

class PropertyCountryJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(Country $society = null)
    {
        $this->model = $society;
        $this->prototype = new PropertyCountryJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->name = $this->model->name;
        return $this->prototype;
    }
}