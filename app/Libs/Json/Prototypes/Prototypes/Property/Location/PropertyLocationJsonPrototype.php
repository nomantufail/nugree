<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 11:18 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property\Location;
use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class PropertyLocationJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    /** @var $city PropertyCityJsonPrototype */
    public $city = null;
    /** @var $city PropertyCountryJsonPrototype */
    public $country = null;
    /** @var $city PropertySubLocationJsonPrototype */
    public $location = null;
    //public $society = null;
    //public $block = null;
}