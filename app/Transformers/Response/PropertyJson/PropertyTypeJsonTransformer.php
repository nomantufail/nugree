<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Response\PropertyJson;

use App\Libs\Json\Prototypes\Prototypes\Property\Owner\PropertyOwnerJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Type\PropertyTypeJsonPrototype;
use App\Transformers\Response\ResponseTransformer;

class PropertyTypeJsonTransformer extends ResponseTransformer{

    public function transform($type /* @var $type PropertyTypeJsonPrototype::class */){
        $transformedType = new PropertyTypeJsonPrototype();
        $transformedType = $type;
        return $transformedType;
    }
} 