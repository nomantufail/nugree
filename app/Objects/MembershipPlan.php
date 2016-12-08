<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/31/2016
 * Time: 11:36 PM
 */

namespace App\Objects;


class MembershipPlan extends Object{
    public $id = null;
    public $name = "";
    public $hot = 0;
    public $featured = 0;
    public $description = "";
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';
} 