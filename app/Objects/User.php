<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/31/2016
 * Time: 11:36 PM
 */

namespace App\Objects;


class User extends Object{

    public $id = null;
    public $email = "";
    public $password = "";
    public $access_token = "";
    public $fName = "";
    public $lName = "";
    public $phone = "";
    public $mobile = "";
    public $fax = "";
    public $address = "";
    public $zipCode = "";
    public $country = null;
    public $notificationSettings = 0;
    public $membershipPlan = null;
    public $membershipStatus = null;
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';
    public $agencies = [];

    public function __construct()
    {
        $this->country = new Country();
        $this->membershipPlan = new MembershipPlan();
    }

    public function toJson()
    {
        return json_encode($this);
    }
} 