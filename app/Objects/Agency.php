<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/31/2016
 * Time: 11:36 PM
 */

namespace App\Objects;


class Agency extends Object{
    public $id = null;
    public $name = "";
    public $description = "";
    public $mobile = "";
    public $phone = "";
    public $address = "";
    public $email = "";
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';
} 