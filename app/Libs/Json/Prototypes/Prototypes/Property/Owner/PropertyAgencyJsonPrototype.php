<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 10:26 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property\Owner;

use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;
class PropertyAgencyJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id = "";
    public $name = "";
    public $address = "";
    public $phone ="";
    public $mobile = "";
    public $fax  = "";
    public $email = "";
    public $logo ="";
    public $slug = "";
}