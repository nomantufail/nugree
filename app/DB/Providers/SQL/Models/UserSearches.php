<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models;

class UserSearches {

    public $id = 0;
    public $purposeId=0;
    public $typeId=0;
    public $subTypeId=0;
    public $countryId=0;
    public $cityId=0;
    public $locationId=0;
    public $priceFrom=0;
    public $priceTo=0;
    public $landUnitId=0;
    public $landAreaFrom=0;
    public $landAreaTo=0;
    public $mobile=0;
    public $email="";

    public $createdBy;
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct()
    {
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }

} 

