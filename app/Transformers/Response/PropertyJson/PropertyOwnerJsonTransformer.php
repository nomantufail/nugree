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
use App\Transformers\Response\ResponseTransformer;

class PropertyOwnerJsonTransformer extends ResponseTransformer{

    public function transform($owner /* @var $owner PropertyOwnerJsonPrototype::class */){

        $transformedOwner = new PropertyOwnerJsonPrototype();
        $transformedOwner->id = $owner->id;
        $transformedOwner->fName = $owner->fName;
        $transformedOwner->lName = $owner->lName;

        return $transformedOwner;
    }
} 