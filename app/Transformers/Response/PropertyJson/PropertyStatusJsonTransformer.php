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
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyStatusJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Type\PropertyTypeJsonPrototype;
use App\Transformers\Response\ResponseTransformer;

class PropertyStatusJsonTransformer extends ResponseTransformer{

    public function transform($status /* @var $status PropertyStatusJsonPrototype::class */){
        $transformedStatus = new PropertyStatusJsonPrototype();
        $transformedStatus = $status;
        return $transformedStatus;
    }
} 