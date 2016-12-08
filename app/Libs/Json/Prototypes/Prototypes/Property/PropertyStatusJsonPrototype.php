<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 11:38 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property;
use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class PropertyStatusJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id = 0;
    public $name = "";
}