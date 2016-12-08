<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 10:05 PM
 */

namespace App\DB\Providers\SQL\Models;


class Agency {
    public $id = 0;
    public $userId = 0;
    public $name = "";
    public $description = "";
    public $mobile = "";
    public $phone = "";
    public $address = "";
    public $email = "";
    public $logo = "";
    public $slug = "";
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct(){
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }
} 