<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 12:25 PM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property;
use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class PropertyFeatureJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id="";
    public $name="";
    public $inputName="";
    public $value="";
    public $priority="";
    public $htmlStructure="";
}