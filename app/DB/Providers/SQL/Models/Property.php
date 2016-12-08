<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models;

class Property {

    public $id = 0;
    public $purposeId;
    public $ownerId;
    public $subTypeId;
    public $locationId;
    public $title;
    public $description;
    public $price;
    public $landUnitId;
    public $landArea;
    public $statusId;
    public $isFeatured;
    public $isHot = 0;
    public $totalViews;
    public $ratings;
    public $totalLikes;
    public $wanted = 0;
    public $isVerified = 0;
    /* contact info */
    public $contactPerson;
    public $phone;
    public $mobile;
    public $fax = "";
    public $email ="";
    public $slug = "";
    public $createdBy;
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';
    public $currentTime ="";

    public function __construct()
    {
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
        $this->currentTime =date('h:i A', strtotime(date('Y-m-d h:i:s')));
    }

} 

