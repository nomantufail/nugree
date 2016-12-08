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
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyPurposeJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Type\PropertyTypeJsonPrototype;
use App\Transformers\Response\ResponseTransformer;

class PropertyPurposeJsonTransformer extends ResponseTransformer{

    public function transform($purpose /* @var $purpose PropertyPurposeJsonPrototype::class */){
        $transformedPurpose = new PropertyPurposeJsonPrototype();
        $transformedPurpose = $purpose;
        return $transformedPurpose;
    }
} 