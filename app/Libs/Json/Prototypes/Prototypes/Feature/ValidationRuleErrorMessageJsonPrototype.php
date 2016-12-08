<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/13/2016
 * Time: 3:30 PM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Feature;


use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class ValidationRuleErrorMessageJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $shortMessage = null;
    public $longMessage = null;
}