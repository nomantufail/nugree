<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 10:05 PM
 */

namespace App\DB\Providers\SQL\Models;
use App\Traits\Authorization\ShouldBeAuthorized;

class User {
    use ShouldBeAuthorized;

    public $id = 0;
    public $fName = "";
    public $lName = "";
    public $email = "";
    public $password = "";
    public $access_token = "";
    public $phone = "";
    public $mobile = "";
    public $fax = "";
    public $address = "";
    public $zipCode = "";
    public $trustedAgent=0;
    public $countryId = 0;
    public $notificationSettings = 0;
    public $membershipPlanId = 0;
    public $membershipStatus = 0;
    public $loginCount = 0;
    public $createdAt = 0;
    public $updatedAt = 0;

    public function __construct(){
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }


} 