<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Response\PropertyJson;

use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Transformers\Response\ResponseTransformer;

class PropertyJsonTransformer extends ResponseTransformer{

    public function transform(PropertyJsonPrototype $property){
        $transformedProperty = new PropertyJsonPrototype();
        $transformedProperty->id = $property->id;
        $transformedProperty->owner = (new PropertyOwnerJsonTransformer())->transform($property->owner);
        $transformedProperty->type = (new PropertyTypeJsonTransformer())->transform($property->type);
        $transformedProperty->totalViews = $property->totalViews;
        $transformedProperty->totalLikes = $property->totalLikes;
        $transformedProperty->title = $property->title;
        $transformedProperty->rating = $property->rating;
        $transformedProperty->purpose = (new PropertyPurposeJsonTransformer())->transform($property->purpose);
        $transformedProperty->propertyStatus = (new PropertyStatusJsonTransformer())->transform($property->propertyStatus);
        $transformedProperty->price = intval($property->price);
        $transformedProperty->location = (new PropertyLocationJsonTransformer())->transform($property->location);
        $transformedProperty->isHot = $property->isHot;
        $transformedProperty->land = (new PropertyLandJsonTransformer())->transform($property->land);
        $transformedProperty->isFeatured = $property->isFeatured;
        $transformedProperty->isDeleted = $property->isDeleted;
        $transformedProperty->features = $property->features;
        $transformedProperty->description = $property->description;
        $transformedProperty->documents = $property->documents;
        $transformedProperty->contactPerson = $property->contactPerson;
        $transformedProperty->mobile = $property->mobile;
        $transformedProperty->phone = $property->phone;
        $transformedProperty->fax = $property->fax;
        $transformedProperty->email = $property->email;
        $transformedProperty->createdBy = $property->createdBy;
        $transformedProperty->createdAt = $property->createdAt;

        return $transformedProperty;
    }
} 