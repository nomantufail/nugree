<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 10:05 PM
 */

namespace App\DB\Providers\SQL\Models;


class UserRequirement {
    public $id = 0;
    public $name  = "";
    public $email = "";
    public $phone = "";
    public $subject = "";
    public $requirement = "";
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct(){
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }
} 