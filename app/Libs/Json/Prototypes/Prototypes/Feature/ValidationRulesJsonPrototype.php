<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/13/2016
 * Time: 4:53 PM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Feature;


use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class ValidationRulesJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id =0;
    public $name = "";
}