<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 11:34 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property\Land;
use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class PropertyLandJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $area = "";
    public $unit = null;
}