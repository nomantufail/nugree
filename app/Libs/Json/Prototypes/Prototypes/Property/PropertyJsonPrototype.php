<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 10:03 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property;


use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Land\PropertyLandJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertyLocationJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Type\PropertyTypeJsonPrototype;

class PropertyJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id = 0;
    public $owner = null;
    public $purpose = null;
    /* @var $type PropertyTypeJsonPrototype::class */
    public $type;
    public $contactPerson="";
    public $phone="";
    public $mobile="";
    public $email="";
    public $fax="";
    /* @var $location PropertyLocationJsonPrototype */
    public $location = null;
    public $title = "";
    public $description = "";
    public $price ="";
    /* @var $land PropertyLandJsonPrototype::class */
    public $land = "";
    /* @var $propertyStatus PropertyStatusJsonPrototype::class*/
    public $propertyStatus =null;
    public $wanted = 0;
    public $isFeatured = "";
    public $isHot ="";
    public $isDeleted ="";
    public $createdBy = "";
    public $totalViews ="";
    public $slug="";
    public $rating ="";
    public $totalLikes = "";
    public $isVerified = 0;
    /* @var $Documents PropertyDocumentsJsonPrototype::class*/
    public $documents = [];
    public $features = [];
    public $createdAt ="";
    public $currentTime="";
}