<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Response\PropertyJson;

use App\Libs\Json\Prototypes\Prototypes\Property\Land\PropertyLandJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Type\PropertyTypeJsonPrototype;
use App\Transformers\Response\ResponseTransformer;

class PropertyLandJsonTransformer extends ResponseTransformer{

    public function transform($land /* @var $land PropertyLandJsonPrototype::class */){
        $transformedLand = new PropertyLandJsonPrototype();
        $transformedLand = $land;
        return $transformedLand;
    }
} 