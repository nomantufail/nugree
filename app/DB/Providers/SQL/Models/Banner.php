<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:37 AM
 */

namespace App\DB\Providers\SQL\Models;


class Banner
{
    public $id = 0;
    public $image ="";
    public $position ="";
    public $bannerType ="";
    public $bannerPriority ="";
    public $bannerLink ="";

    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct(){
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }

}