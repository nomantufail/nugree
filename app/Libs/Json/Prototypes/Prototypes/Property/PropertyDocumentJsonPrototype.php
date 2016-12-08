<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 11:58 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property;
use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class PropertyDocumentJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id = "";
    public $type = "";
    public $path ="";
    public $title = "";
    public $main = false;
}