<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/17/2016
 * Time: 2:58 PM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Feature;


use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class SectionFeaturesJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $priority = null;
    public $features =[];
    public $sectionName = "";
}