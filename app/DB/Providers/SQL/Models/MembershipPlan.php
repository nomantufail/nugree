<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 10:05 PM
 */

namespace App\DB\Providers\SQL\Models;


class MembershipPlan {
    public $id = 0;
    public $name = "";
    public $description = "";
    public $featured = "";
    public $hot = "";
    public $createdAt = "";
    public $updatedAt = "";

    public function __construct(){
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }
} 