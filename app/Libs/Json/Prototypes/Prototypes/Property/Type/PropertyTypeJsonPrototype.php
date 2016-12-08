<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 10:39 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property\Type;
use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class PropertyTypeJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $parentType = null;
    public $subType = null;
}